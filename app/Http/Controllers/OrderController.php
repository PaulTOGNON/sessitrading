<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $cart = CartService::getCart();

        if (empty($cart)) {
            return redirect()->back()->withErrors(['cart' => 'Votre panier est vide.']);
        }

        $totalAmount = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['product']->price * $item['quantity']);
        }, 0);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'En cours',
                'total_amount' => $totalAmount,
                'shipping_address' => $request->input('shipping_address'),
                'shipping_city' => $request->input('shipping_city'),
                'shipping_country' => $request->input('shipping_country'),
                'phone_number' => $request->input('phone_number'),
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity'],
                ]);
            }

            // Clear the cart
            CartService::clear();

            DB::commit();

            $fedaPayService = app(\App\Services\FedaPayService::class);
            if ($fedaPayService->isEnabled()) {
                return redirect()->route('checkout.pay', ['order' => $order->id]);
            }

            return redirect()->route('dashboard', ['tab' => 'orders'])
                ->with('success', 'Votre commande a été passée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la commande : ' . $e->getMessage()]);
        }
    }
}
