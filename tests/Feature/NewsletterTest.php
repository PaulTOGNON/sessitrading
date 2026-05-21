<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\NewsletterSubscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a guest can subscribe to the newsletter with a valid email.
     */
    public function test_guest_can_subscribe_with_valid_email(): void
    {
        $response = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'client@example.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Votre inscription à la newsletter a été enregistrée avec succès !',
        ]);

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'client@example.com',
        ]);
    }

    /**
     * Test newsletter subscription validation.
     */
    public function test_newsletter_subscription_validation(): void
    {
        // Test missing email
        $response = $this->postJson(route('newsletter.subscribe'), []);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'L\'adresse e-mail est requise.',
        ]);

        // Test invalid email format
        $response = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'invalid-email',
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'L\'adresse e-mail doit être valide.',
        ]);
    }

    /**
     * Test duplicate subscription prevention and case insensitivity.
     */
    public function test_duplicate_subscription_is_prevented(): void
    {
        // First subscription
        $this->postJson(route('newsletter.subscribe'), [
            'email' => 'Duplicate@Example.Com',
        ])->assertStatus(200);

        // Duplicate subscription with same email
        $response1 = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'Duplicate@Example.Com',
        ]);
        $response1->assertStatus(422);
        $response1->assertJson([
            'message' => 'Cette adresse e-mail est déjà inscrite à la newsletter.',
        ]);

        // Duplicate subscription with different case
        $response2 = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'duplicate@example.com',
        ]);
        $response2->assertStatus(422);
        $response2->assertJson([
            'message' => 'Cette adresse e-mail est déjà inscrite à la newsletter.',
        ]);
    }

    /**
     * Test guest cannot access admin newsletter subscribers list.
     */
    public function test_guest_cannot_access_subscribers_list(): void
    {
        $response = $this->get(route('admin.newsletter.index'));
        $response->assertRedirect('/login');
    }

    /**
     * Test regular customer cannot access admin newsletter subscribers list.
     */
    public function test_customer_cannot_access_subscribers_list(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.newsletter.index'));
        $response->assertStatus(403);
    }

    /**
     * Test admin can access admin newsletter subscribers list and search.
     */
    public function test_admin_can_view_and_search_subscribers(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        NewsletterSubscriber::create(['email' => 'target@example.com']);
        NewsletterSubscriber::create(['email' => 'other@example.com']);

        // View all
        $response = $this->actingAs($admin)->get(route('admin.newsletter.index'));
        $response->assertStatus(200);
        $response->assertSee('target@example.com');
        $response->assertSee('other@example.com');

        // Search
        $responseSearch = $this->actingAs($admin)->get(route('admin.newsletter.index', ['q' => 'target']));
        $responseSearch->assertStatus(200);
        $responseSearch->assertSee('target@example.com');
        $responseSearch->assertDontSee('other@example.com');
    }

    /**
     * Test admin can delete a subscriber, but customer/guest cannot.
     */
    public function test_delete_subscriber_authorization_and_functionality(): void
    {
        $subscriber = NewsletterSubscriber::create(['email' => 'todelete@example.com']);

        // Guest cannot delete
        $responseGuest = $this->delete(route('admin.newsletter.destroy', $subscriber));
        $responseGuest->assertRedirect('/login');
        $this->assertDatabaseHas('newsletter_subscribers', ['id' => $subscriber->id]);

        // Customer cannot delete
        $customer = User::factory()->create(['is_admin' => false]);
        $responseCustomer = $this->actingAs($customer)->delete(route('admin.newsletter.destroy', $subscriber));
        $responseCustomer->assertStatus(403);
        $this->assertDatabaseHas('newsletter_subscribers', ['id' => $subscriber->id]);

        // Admin can delete
        $admin = User::factory()->create(['is_admin' => true]);
        $responseAdmin = $this->actingAs($admin)->delete(route('admin.newsletter.destroy', $subscriber));
        $responseAdmin->assertRedirect();
        $responseAdmin->assertSessionHas('success');
        $this->assertDatabaseMissing('newsletter_subscribers', ['id' => $subscriber->id]);
    }

    /**
     * Test export functionality.
     */
    public function test_export_subscribers_authorization_and_output(): void
    {
        NewsletterSubscriber::create(['email' => 'export1@example.com']);
        NewsletterSubscriber::create(['email' => 'export2@example.com']);

        // Guest cannot export
        $responseGuest = $this->get(route('admin.newsletter.export'));
        $responseGuest->assertRedirect('/login');

        // Customer cannot export
        $customer = User::factory()->create(['is_admin' => false]);
        $responseCustomer = $this->actingAs($customer)->get(route('admin.newsletter.export'));
        $responseCustomer->assertStatus(403);

        // Admin can export
        $admin = User::factory()->create(['is_admin' => true]);
        
        $responseAdmin = $this->actingAs($admin)->get(route('admin.newsletter.export'));
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertHeader('Content-type', 'text/csv; charset=UTF-8');
        
        // Read streamed content
        ob_start();
        $responseAdmin->sendContent();
        $content = ob_get_clean();

        // Verify CSV content (BOM + Headers + Data)
        $this->assertStringContainsString('ID', $content);
        $this->assertStringContainsString('Email', $content);
        $this->assertStringContainsString('Date d\'inscription', $content);
        $this->assertStringContainsString('export1@example.com', $content);
        $this->assertStringContainsString('export2@example.com', $content);
    }
}
