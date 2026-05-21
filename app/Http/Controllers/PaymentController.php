<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\FedaPayTransaction;
use App\Services\FedaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $fedaPayService;

    public function __construct(FedaPayService $fedaPayService)
    {
        $this->fedaPayService = $fedaPayService;
    }

    /**
     * Redirect customer to FedaPay checkout page.
     */
    public function pay(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        if (!$this->fedaPayService->isEnabled()) {
            return redirect()->route('dashboard', ['tab' => 'orders'])
                ->with('error', 'Le système de paiement Mobile Money n\'est pas activé.');
        }

        if ($order->payment_status === 'Payé') {
            return redirect()->route('dashboard', ['tab' => 'orders'])
                ->with('info', 'Cette commande a déjà été payée.');
        }

        $user = Auth::user();
        
        // Prepare customer payload
        $customerData = [
            'first_name' => $user->first_name ?? explode(' ', $user->name)[0],
            'last_name' => $user->last_name ?? (explode(' ', $user->name)[1] ?? 'Client'),
            'email' => $user->email,
            'phone_number' => $order->phone_number,
        ];

        try {
            $fedaPayTx = $this->fedaPayService->createTransaction($order, $customerData);

            // Log the transaction in our database
            FedaPayTransaction::create([
                'order_id' => $order->id,
                'transaction_id' => $fedaPayTx->id,
                'reference' => $fedaPayTx->reference,
                'amount' => $fedaPayTx->amount,
                'currency' => $this->fedaPayService->getCurrency(),
                'status' => $fedaPayTx->status ?? 'pending',
                'payment_method' => $fedaPayTx->payment_method ?? null,
                'raw_response' => json_encode($fedaPayTx),
            ]);

            // Generate token / redirect URL
            $token = $fedaPayTx->generateToken();

            return redirect()->away($token->url);

        } catch (\Exception $e) {
            return redirect()->route('dashboard', ['tab' => 'orders'])
                ->with('error', 'Erreur d\'initialisation du paiement : ' . $e->getMessage());
        }
    }

    /**
     * FedaPay redirection callback page.
     */
    public function callback(Request $request, Order $order)
    {
        $transactionId = $request->input('id');

        if (!$transactionId) {
            $lastTx = $order->transactions()->latest()->first();
            $transactionId = $lastTx ? $lastTx->transaction_id : null;
        }

        if (!$transactionId) {
            return redirect()->route('dashboard', ['tab' => 'orders'])
                ->with('error', 'Aucune transaction de paiement correspondante trouvée.');
        }

        try {
            $fedaPayTx = $this->fedaPayService->getTransactionDetails($transactionId);

            $localTx = FedaPayTransaction::where('transaction_id', $transactionId)->first();
            if (!$localTx) {
                $localTx = new FedaPayTransaction([
                    'order_id' => $order->id,
                    'transaction_id' => $transactionId,
                ]);
            }

            $localTx->fill([
                'reference' => $fedaPayTx->reference,
                'amount' => $fedaPayTx->amount,
                'currency' => $fedaPayTx->currency,
                'status' => $fedaPayTx->status,
                'payment_method' => $fedaPayTx->payment_method,
                'raw_response' => json_encode($fedaPayTx),
            ])->save();

            if ($fedaPayTx->status === 'approved') {
                $order->update([
                    'payment_status' => 'Payé',
                    'status' => 'confirmed',
                ]);

                return view('store.payment-success', compact('order', 'localTx'));
            } else {
                $order->update([
                    'payment_status' => 'Échoué',
                ]);

                return view('store.payment-failed', compact('order', 'localTx'));
            }

        } catch (\Exception $e) {
            return redirect()->route('dashboard', ['tab' => 'orders'])
                ->with('error', 'Erreur de vérification du paiement : ' . $e->getMessage());
        }
    }

    /**
     * Webhook handler for asynchronous FedaPay state updates.
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('X-FEDAPAY-SIGNATURE');

        if (!$sigHeader) {
            return response()->json(['error' => 'Header de signature manquant'], 400);
        }

        try {
            $event = $this->fedaPayService->verifyWebhook($payload, $sigHeader);
            $eventData = $event->data;

            if ($event->name === 'transaction.approved' || $event->name === 'transaction.canceled' || $event->name === 'transaction.declined') {
                $transactionId = $eventData['id'] ?? null;
                if ($transactionId) {
                    $localTx = FedaPayTransaction::where('transaction_id', $transactionId)->first();
                    if ($localTx) {
                        $status = 'pending';
                        if ($event->name === 'transaction.approved') {
                            $status = 'approved';
                        } elseif ($event->name === 'transaction.canceled') {
                            $status = 'canceled';
                        } elseif ($event->name === 'transaction.declined') {
                            $status = 'declined';
                        }

                        $localTx->update([
                            'status' => $status,
                            'reference' => $eventData['reference'] ?? $localTx->reference,
                            'payment_method' => $eventData['payment_method'] ?? $localTx->payment_method,
                            'raw_response' => json_encode($eventData),
                        ]);

                        $order = $localTx->order;
                        if ($order) {
                            if ($status === 'approved') {
                                $order->update([
                                    'payment_status' => 'Payé',
                                    'status' => 'confirmed',
                                ]);
                            } elseif (in_array($status, ['canceled', 'declined'])) {
                                $order->update([
                                    'payment_status' => 'Échoué',
                                ]);
                            }
                        }
                    }
                }
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            logger()->error('FedaPay Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
