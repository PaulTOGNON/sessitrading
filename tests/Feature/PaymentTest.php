<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\PaymentSetting;
use App\Models\FedaPayTransaction;
use App\Services\FedaPayService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MockFedaPayTransaction
{
    public $id = '99999';
    public $reference = 'tok_test_ref';
    public $amount = 5000;
    public $status = 'pending';
    public $payment_method = 'mtn';
    public $currency = 'XOF';

    public function generateToken()
    {
        return (object) ['url' => 'https://checkout.fedapay.com/test-token-url'];
    }
}

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\ProductSeeder::class);
    }

    /**
     * Test guests cannot access payment settings.
     */
    public function test_guest_cannot_access_payment_settings(): void
    {
        $response = $this->get(route('admin.payment-settings.index'));
        $response->assertRedirect('/login');
    }

    /**
     * Test normal customers cannot access payment settings.
     */
    public function test_customer_cannot_access_payment_settings(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get(route('admin.payment-settings.index'));
        $response->assertStatus(403);
    }

    /**
     * Test admins can access payment settings.
     */
    public function test_admin_can_access_payment_settings(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->get(route('admin.payment-settings.index'));
        $response->assertStatus(200);
        $response->assertSee('Configuration de FedaPay');
    }

    /**
     * Test admins can update payment settings.
     */
    public function test_admin_can_update_payment_settings(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.payment-settings.update'), [
            'is_enabled' => '1',
            'environment' => 'sandbox',
            'public_key' => 'pk_sandbox_123',
            'secret_key' => 'sk_sandbox_123',
            'webhook_secret' => 'whsec_123',
            'currency' => 'XOF',
        ]);

        $response->assertRedirect(route('admin.payment-settings.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('payment_settings', [
            'is_enabled' => true,
            'environment' => 'sandbox',
            'public_key' => 'pk_sandbox_123',
            'secret_key' => 'sk_sandbox_123',
            'webhook_secret' => 'whsec_123',
            'currency' => 'XOF',
        ]);
    }

    /**
     * Test guest cannot access transactions page.
     */
    public function test_guest_cannot_access_transactions(): void
    {
        $response = $this->get(route('admin.transactions.index'));
        $response->assertRedirect('/login');
    }

    /**
     * Test customer cannot access transactions page.
     */
    public function test_customer_cannot_access_transactions(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get(route('admin.transactions.index'));
        $response->assertStatus(403);
    }

    /**
     * Test admin can access transactions page.
     */
    public function test_admin_can_access_transactions(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->get(route('admin.transactions.index'));
        $response->assertStatus(200);
        $response->assertSee('Transactions FedaPay');
    }

    /**
     * Test checkout redirects to payment gateway route when FedaPay is enabled.
     */
    public function test_checkout_redirects_to_pay_when_fedapay_enabled(): void
    {
        // 1. Enable FedaPay settings
        PaymentSetting::query()->updateOrCreate(['id' => 1], [
            'is_enabled' => true,
            'public_key' => 'pk_test',
            'secret_key' => 'sk_test',
        ]);

        // 2. Set up customer and cart
        $user = User::factory()->create();
        $product = Product::allStatic()->first();

        $this->actingAs($user)->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // 3. Mock FedaPayService in container to ensure it says isEnabled() is true
        $this->mock(FedaPayService::class, function ($mock) {
            $mock->shouldReceive('isEnabled')->andReturn(true);
        });

        // 4. Place order
        $response = $this->actingAs($user)->post(route('orders.store'), [
            'shipping_address' => '123 Rue Benin',
            'shipping_city' => 'Cotonou',
            'shipping_country' => 'Bénin',
            'phone_number' => '+22990000000',
        ]);

        $order = Order::where('user_id', $user->id)->first();
        $this->assertNotNull($order);

        $response->assertRedirect(route('checkout.pay', ['order' => $order->id]));
    }

    /**
     * Test checkout redirects directly to dashboard when FedaPay is disabled.
     */
    public function test_checkout_redirects_to_dashboard_when_fedapay_disabled(): void
    {
        // 1. Disable FedaPay settings
        PaymentSetting::query()->updateOrCreate(['id' => 1], [
            'is_enabled' => false,
        ]);

        // 2. Set up customer and cart
        $user = User::factory()->create();
        $product = Product::allStatic()->first();

        $this->actingAs($user)->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // 3. Mock FedaPayService in container to return isEnabled() is false
        $this->mock(FedaPayService::class, function ($mock) {
            $mock->shouldReceive('isEnabled')->andReturn(false);
        });

        // 4. Place order
        $response = $this->actingAs($user)->post(route('orders.store'), [
            'shipping_address' => '123 Rue Benin',
            'shipping_city' => 'Cotonou',
            'shipping_country' => 'Bénin',
            'phone_number' => '+22990000000',
        ]);

        $response->assertRedirect(route('dashboard', ['tab' => 'orders']));
        $response->assertSessionHas('success');
    }

    /**
     * Test paying page redirects to FedaPay checkout page and logs a pending transaction.
     */
    public function test_payment_page_redirects_to_fedapay(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'En cours',
            'total_amount' => 5000,
            'shipping_address' => 'Addr',
            'shipping_city' => 'City',
            'shipping_country' => 'Country',
            'phone_number' => '+22990000000',
        ]);

        // Mock FedaPayService
        $this->mock(FedaPayService::class, function ($mock) use ($order) {
            $mock->shouldReceive('isEnabled')->andReturn(true);
            $mock->shouldReceive('getCurrency')->andReturn('XOF');
            
            $mockTx = new MockFedaPayTransaction();
            $mockTx->status = 'pending';
            
            $mock->shouldReceive('createTransaction')
                ->once()
                ->with(\Mockery::on(function ($arg) use ($order) {
                    return $arg->id === $order->id;
                }), \Mockery::type('array'))
                ->andReturn($mockTx);
        });

        $response = $this->actingAs($user)->get(route('checkout.pay', ['order' => $order->id]));

        $response->assertRedirect('https://checkout.fedapay.com/test-token-url');

        $this->assertDatabaseHas('fedapay_transactions', [
            'order_id' => $order->id,
            'transaction_id' => '99999',
            'reference' => 'tok_test_ref',
            'amount' => 5000,
            'status' => 'pending',
        ]);
    }

    /**
     * Test callback handler for approved payment.
     */
    public function test_payment_callback_handles_approved_payment(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'En cours',
            'total_amount' => 5000,
            'shipping_address' => 'Addr',
            'shipping_city' => 'City',
            'shipping_country' => 'Country',
            'phone_number' => '+22990000000',
            'payment_status' => 'Non payé',
        ]);

        FedaPayTransaction::create([
            'order_id' => $order->id,
            'transaction_id' => '99999',
            'reference' => 'tok_test_ref',
            'amount' => 5000,
            'currency' => 'XOF',
            'status' => 'pending',
        ]);

        // Mock FedaPayService getTransactionDetails
        $this->mock(FedaPayService::class, function ($mock) {
            $mockTx = new MockFedaPayTransaction();
            $mockTx->status = 'approved';
            $mockTx->payment_method = 'mtn';

            $mock->shouldReceive('getTransactionDetails')
                ->once()
                ->with('99999')
                ->andReturn($mockTx);
        });

        $response = $this->actingAs($user)->get(route('checkout.callback', [
            'order' => $order->id,
            'id' => '99999'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('store.payment-success');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_status' => 'Payé',
            'status' => 'confirmed',
        ]);

        $this->assertDatabaseHas('fedapay_transactions', [
            'transaction_id' => '99999',
            'status' => 'approved',
            'payment_method' => 'mtn',
        ]);
    }

    /**
     * Test callback handler for failed payment.
     */
    public function test_payment_callback_handles_failed_payment(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'En cours',
            'total_amount' => 5000,
            'shipping_address' => 'Addr',
            'shipping_city' => 'City',
            'shipping_country' => 'Country',
            'phone_number' => '+22990000000',
            'payment_status' => 'Non payé',
        ]);

        FedaPayTransaction::create([
            'order_id' => $order->id,
            'transaction_id' => '99999',
            'reference' => 'tok_test_ref',
            'amount' => 5000,
            'currency' => 'XOF',
            'status' => 'pending',
        ]);

        // Mock FedaPayService getTransactionDetails
        $this->mock(FedaPayService::class, function ($mock) {
            $mockTx = new MockFedaPayTransaction();
            $mockTx->status = 'failed';
            $mockTx->payment_method = 'moov';

            $mock->shouldReceive('getTransactionDetails')
                ->once()
                ->with('99999')
                ->andReturn($mockTx);
        });

        $response = $this->actingAs($user)->get(route('checkout.callback', [
            'order' => $order->id,
            'id' => '99999'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('store.payment-failed');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_status' => 'Échoué',
        ]);

        $this->assertDatabaseHas('fedapay_transactions', [
            'transaction_id' => '99999',
            'status' => 'failed',
            'payment_method' => 'moov',
        ]);
    }

    /**
     * Test webhook updates transaction and order status on approved event.
     */
    public function test_webhook_handles_approved_event(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'En cours',
            'total_amount' => 5000,
            'shipping_address' => 'Addr',
            'shipping_city' => 'City',
            'shipping_country' => 'Country',
            'phone_number' => '+22990000000',
            'payment_status' => 'Non payé',
        ]);

        FedaPayTransaction::create([
            'order_id' => $order->id,
            'transaction_id' => '99999',
            'reference' => 'tok_test_ref',
            'amount' => 5000,
            'currency' => 'XOF',
            'status' => 'pending',
        ]);

        // Mock verifyWebhook
        $this->mock(FedaPayService::class, function ($mock) {
            $mockEvent = (object) [
                'name' => 'transaction.approved',
                'data' => [
                    'id' => '99999',
                    'reference' => 'tok_approved_ref',
                    'payment_method' => 'mtn',
                ]
            ];

            $mock->shouldReceive('verifyWebhook')
                ->once()
                ->andReturn($mockEvent);
        });

        $response = $this->postJson(route('checkout.webhook'), [], [
            'X-FEDAPAY-SIGNATURE' => 'valid-sig-header-value',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_status' => 'Payé',
            'status' => 'confirmed',
        ]);

        $this->assertDatabaseHas('fedapay_transactions', [
            'transaction_id' => '99999',
            'status' => 'approved',
            'reference' => 'tok_approved_ref',
            'payment_method' => 'mtn',
        ]);
    }

    /**
     * Test webhook updates transaction and order status on declined event.
     */
    public function test_webhook_handles_declined_event(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'En cours',
            'total_amount' => 5000,
            'shipping_address' => 'Addr',
            'shipping_city' => 'City',
            'shipping_country' => 'Country',
            'phone_number' => '+22990000000',
            'payment_status' => 'Non payé',
        ]);

        FedaPayTransaction::create([
            'order_id' => $order->id,
            'transaction_id' => '99999',
            'reference' => 'tok_test_ref',
            'amount' => 5000,
            'currency' => 'XOF',
            'status' => 'pending',
        ]);

        // Mock verifyWebhook
        $this->mock(FedaPayService::class, function ($mock) {
            $mockEvent = (object) [
                'name' => 'transaction.declined',
                'data' => [
                    'id' => '99999',
                    'reference' => 'tok_declined_ref',
                    'payment_method' => 'moov',
                ]
            ];

            $mock->shouldReceive('verifyWebhook')
                ->once()
                ->andReturn($mockEvent);
        });

        $response = $this->postJson(route('checkout.webhook'), [], [
            'X-FEDAPAY-SIGNATURE' => 'valid-sig-header-value',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_status' => 'Échoué',
        ]);

        $this->assertDatabaseHas('fedapay_transactions', [
            'transaction_id' => '99999',
            'status' => 'declined',
            'reference' => 'tok_declined_ref',
            'payment_method' => 'moov',
        ]);
    }
}
