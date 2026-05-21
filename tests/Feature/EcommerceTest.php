<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EcommerceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test adding to cart as a guest.
     */
    public function test_guest_can_add_item_to_cart(): void
    {
        $product = Product::allStatic()->first();
        $this->assertNotNull($product);

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->assertEquals(2, session()->get('cart')[$product->id]);
    }

    /**
     * Test adding to cart as an authenticated user.
     */
    public function test_authenticated_user_can_add_item_to_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::allStatic()->first();

        $response = $this->actingAs($user)->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('cart_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 3,
        ]);
    }

    /**
     * Test merging guest cart into user cart upon login.
     */
    public function test_guest_to_user_cart_merging_on_login(): void
    {
        $product = Product::allStatic()->first();

        // 1. Add as guest
        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // 2. Create user and login
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticated();

        // 3. Verify cart items are now in the DB
        $this->assertDatabaseHas('cart_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // 4. Verify guest session cart is cleared
        $this->assertNull(session()->get('cart'));
    }

    /**
     * Test wishlist toggle functionality.
     */
    public function test_favorite_toggling(): void
    {
        // For guest
        $product = Product::allStatic()->first();

        $response = $this->post(route('favorites.toggle'), [
            'product_id' => $product->id,
        ]);

        $response->assertStatus(200);
        $this->assertContains($product->id, session()->get('favorites', []));

        // For user
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('favorites.toggle'), [
            'product_id' => $product->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    /**
     * Test placing an order.
     */
    public function test_user_can_place_order(): void
    {
        $user = User::factory()->create([
            'address' => '123 Rue de Cotonou',
            'city' => 'Cotonou',
            'country' => 'Bénin',
            'phone_number' => '+22990000000',
        ]);

        $product = Product::allStatic()->first();

        // Add to cart as user
        $this->actingAs($user)->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Place order
        $response = $this->actingAs($user)->post(route('orders.store'), [
            'shipping_address' => '456 Rue Pavée',
            'shipping_city' => 'Porto-Novo',
            'shipping_country' => 'Bénin',
            'phone_number' => '+22991112233',
        ]);

        $response->assertRedirect(route('dashboard', ['tab' => 'orders']));
        $response->assertSessionHas('success');

        // Check order recorded in database
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'shipping_address' => '456 Rue Pavée',
            'shipping_city' => 'Porto-Novo',
            'shipping_country' => 'Bénin',
            'phone_number' => '+22991112233',
            'total_amount' => $product->price * 2,
        ]);

        $order = Order::where('user_id', $user->id)->first();
        $this->assertNotNull($order);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'quantity' => 2,
        ]);

        // Verify cart is cleared
        $this->assertDatabaseMissing('cart_items', [
            'user_id' => $user->id,
        ]);
    }
}
