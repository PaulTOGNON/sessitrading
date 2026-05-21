<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_can_register_with_ecommerce_fields(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'phone_number' => '+229 01 02 03 04',
            'address' => 'Rue 123, Cotonou',
            'city' => 'Cotonou',
            'country' => 'Bénin',
            'email' => 'jean.dupont@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $user = \App\Models\User::where('email', 'jean.dupont@example.com')->first();
        $this->assertNotNull($user);
        $this->assertSame('Jean Dupont', $user->name);
        $this->assertSame('Jean', $user->first_name);
        $this->assertSame('Dupont', $user->last_name);
        $this->assertSame('+229 01 02 03 04', $user->phone_number);
        $this->assertSame('Rue 123, Cotonou', $user->address);
        $this->assertSame('Cotonou', $user->city);
        $this->assertSame('Bénin', $user->country);
    }
}
