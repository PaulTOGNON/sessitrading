<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed products so allStatic has values
        $this->seed(\Database\Seeders\ProductSeeder::class);
    }

    /**
     * Test guest cannot access admin dashboard.
     */
    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect('/login');
    }

    /**
     * Test normal customer cannot access admin dashboard.
     */
    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    /**
     * Test admin can access admin dashboard.
     */
    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Tableau de Bord');
    }

    /**
     * Test admin login redirects to admin dashboard.
     */
    public function test_admin_login_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test customer login redirects to customer dashboard.
     */
    public function test_customer_login_redirects_to_customer_dashboard(): void
    {
        $customer = User::factory()->create([
            'is_admin' => false,
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $customer->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($customer);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * Test admin visiting customer dashboard redirects to admin dashboard.
     */
    public function test_admin_visiting_customer_dashboard_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test admin can view users list.
     */
    public function test_admin_can_view_users(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $customer = User::factory()->create(['name' => 'Jean Client', 'is_admin' => false]);

        $response = $this->actingAs($admin)->get(route('admin.users', ['q' => 'Jean']));
        $response->assertStatus(200);
        $response->assertSee('Jean Client');
    }

    /**
     * Test admin can update a user's details.
     */
    public function test_admin_can_update_user(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $customer = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($admin)->post(route('admin.users.update', $customer), [
            'first_name' => 'Marc',
            'last_name' => 'Client',
            'email' => 'marc@client.com',
            'phone_number' => '+22912345678',
            'address' => 'Cotonou',
            'city' => 'Cotonou',
            'country' => 'Bénin',
            'is_admin' => '1',
            'is_suspended' => '0',
        ]);

        $response->assertSessionHas('success');
        
        $customer->refresh();
        $this->assertEquals('Marc Client', $customer->name);
        $this->assertTrue((bool)$customer->is_admin);
    }

    /**
     * Test admin cannot demote or suspend themselves.
     */
    public function test_admin_cannot_deadmin_or_suspend_self(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        // Attempt demote
        $response = $this->actingAs($admin)->post(route('admin.users.update', $admin), [
            'first_name' => $admin->first_name,
            'last_name' => $admin->last_name,
            'email' => $admin->email,
            'is_admin' => '0',
            'is_suspended' => '0',
        ]);
        $response->assertSessionHas('error');

        // Attempt toggle suspend via toggle route
        $response2 = $this->actingAs($admin)->post(route('admin.users.toggle', $admin));
        $response2->assertSessionHas('error');

        $admin->refresh();
        $this->assertTrue((bool)$admin->is_admin);
        $this->assertFalse((bool)$admin->is_suspended);
    }

    /**
     * Test admin can toggle user suspension status.
     */
    public function test_admin_can_suspend_user(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $customer = User::factory()->create(['is_admin' => false, 'is_suspended' => false]);

        $response = $this->actingAs($admin)->post(route('admin.users.toggle', $customer));
        $response->assertSessionHas('success');

        $customer->refresh();
        $this->assertTrue((bool)$customer->is_suspended);

        // Untoggle
        $this->actingAs($admin)->post(route('admin.users.toggle', $customer));
        $customer->refresh();
        $this->assertFalse((bool)$customer->is_suspended);
    }

    /**
     * Test suspended user cannot log in.
     */
    public function test_suspended_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('SecurePassword123!'),
            'is_suspended' => true,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'SecurePassword123!',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test admin can view orders.
     */
    public function test_admin_can_view_orders(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $customer = User::factory()->create();
        
        $order = Order::create([
            'user_id' => $customer->id,
            'total_amount' => 30000,
            'status' => 'pending',
            'shipping_address' => 'Cotonou',
            'shipping_city' => 'Cotonou',
            'shipping_country' => 'Bénin',
            'phone_number' => '+22990909090',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.orders'));
        $response->assertStatus(200);
        $response->assertSee('30 000 F');
    }

    /**
     * Test admin can update order status.
     */
    public function test_admin_can_update_order_status(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $customer = User::factory()->create();
        
        $order = Order::create([
            'user_id' => $customer->id,
            'total_amount' => 30000,
            'status' => 'pending',
            'shipping_address' => 'Cotonou',
            'shipping_city' => 'Cotonou',
            'shipping_country' => 'Bénin',
            'phone_number' => '+22990909090',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.orders.status', $order), [
            'status' => 'shipped',
        ]);

        $response->assertSessionHas('success');
        $order->refresh();
        $this->assertEquals('shipped', $order->status);
    }

    /**
     * Test admin can view products.
     */
    public function test_admin_can_view_products(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.products'));
        $response->assertStatus(200);
        $response->assertSee('Boubou oversized');
    }

    /**
     * Test admin can create a product.
     */
    public function test_admin_can_create_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Nouveau Boubou Royal',
            'price' => 25000,
            'original_price' => 30000,
            'category' => 'Boubous',
            'description' => 'Un boubou magnifique pour les occasions royales.',
            'stock' => 10,
            'is_popular' => '1',
            'is_new' => '1',
        ]);

        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('products', [
            'name' => 'Nouveau Boubou Royal',
            'price' => 25000,
            'category' => 'Boubous',
            'stock' => 10,
            'is_popular' => true,
            'is_new' => true,
        ]);
    }

    /**
     * Test admin can update a product.
     */
    public function test_admin_can_update_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::allStatic()->first();

        $response = $this->actingAs($admin)->post(route('admin.products.update', $product), [
            'name' => 'Boubou oversized modifié',
            'price' => 17000,
            'original_price' => 20000,
            'category' => 'Boubous',
            'description' => 'Description modifiée pour ce superbe boubou.',
            'stock' => 5,
            'is_popular' => '0',
            'is_new' => '0',
        ]);

        $response->assertSessionHas('success');
        
        $product->refresh();
        $this->assertEquals('Boubou oversized modifié', $product->name);
        $this->assertEquals(17000, $product->price);
        $this->assertFalse((bool)$product->is_popular);
    }

    /**
     * Test admin can delete a product.
     */
    public function test_admin_can_delete_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::allStatic()->first();

        $response = $this->actingAs($admin)->delete(route('admin.products.destroy', $product));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
