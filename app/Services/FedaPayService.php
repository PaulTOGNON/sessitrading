<?php

namespace App\Services;

use App\Models\PaymentSetting;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use FedaPay\Webhook;

class FedaPayService
{
    protected $isEnabled;
    protected $environment;
    protected $publicKey;
    protected $secretKey;
    protected $webhookSecret;
    protected $currency;

    public function __construct()
    {
        $settings = PaymentSetting::getSettings();
        
        $this->isEnabled = $settings->is_enabled;
        $this->environment = $settings->environment;
        $this->publicKey = $settings->public_key;
        $this->secretKey = $settings->secret_key;
        $this->webhookSecret = $settings->webhook_secret;
        $this->currency = $settings->currency ?? 'XOF';
        
        // Initialize FedaPay SDK if credentials are set
        if ($this->secretKey) {
            FedaPay::setApiKey($this->secretKey);
            FedaPay::setEnvironment($this->environment);
        }
    }

    /**
     * Check if payment method is ready and configured.
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled && !empty($this->publicKey) && !empty($this->secretKey);
    }

    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Create a checkout transaction on FedaPay.
     */
    public function createTransaction($order, array $customerData)
    {
        if (!$this->isEnabled()) {
            throw new \Exception("FedaPay n'est pas activé ou les clés API ne sont pas configurées.");
        }

        // Clean up phone number: keep only digits and plus sign, and strip leading zeros or spaces
        $phone = preg_replace('/[^0-9+]/', '', $customerData['phone_number'] ?? $order->phone_number);

        // Detect country code (default to Benin 'bj')
        $countryCode = 'bj';
        if (str_starts_with($phone, '+228')) {
            $countryCode = 'tg';
        } elseif (str_starts_with($phone, '+221')) {
            $countryCode = 'sn';
        } elseif (str_starts_with($phone, '+225')) {
            $countryCode = 'ci';
        } elseif (str_starts_with($phone, '+223')) {
            $countryCode = 'ml';
        } elseif (str_starts_with($phone, '+226')) {
            $countryCode = 'bf';
        } elseif (str_starts_with($phone, '+227')) {
            $countryCode = 'ne';
        }

        $params = [
            'description' => 'Commande #' . $order->id . ' chez Sessitrading',
            'amount' => (int) $order->total_amount,
            'currency' => ['iso' => $this->currency],
            'callback_url' => route('checkout.callback', ['order' => $order->id]),
            'customer' => [
                'firstname' => $customerData['first_name'] ?? 'Client',
                'lastname' => $customerData['last_name'] ?? 'Sessitrading',
                'email' => $customerData['email'],
                'phone_number' => [
                    'number' => $phone,
                    'country' => $countryCode
                ]
            ]
        ];

        return Transaction::create($params);
    }

    /**
     * Retrieve transaction details from FedaPay.
     */
    public function getTransactionDetails($transactionId)
    {
        if (!$this->isEnabled()) {
            throw new \Exception("FedaPay n'est pas configuré.");
        }
        return Transaction::retrieve($transactionId);
    }

    /**
     * Verify a webhook event signature.
     */
    public function verifyWebhook($payload, string $signatureHeader)
    {
        if (empty($this->webhookSecret)) {
            throw new \Exception("Le secret de webhook FedaPay n'est pas configuré.");
        }

        return Webhook::constructEvent($payload, $signatureHeader, $this->webhookSecret);
    }
}
