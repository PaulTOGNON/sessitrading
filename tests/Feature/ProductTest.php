<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test the store homepage.
     */
    public function test_store_homepage_renders_correctly(): void
    {
        $response = $this->get(route('store.index'));

        $response->assertStatus(200);
        $response->assertSee('Boubou oversized');
        $response->assertSee('15 000');
    }

    /**
     * Test the product detail page.
     */
    public function test_product_detail_page_renders_correctly(): void
    {
        $response = $this->get(route('store.show', 'boubou-oversized'));

        $response->assertStatus(200);
        $response->assertSee('Boubou oversized');
        $response->assertSee('Un magnifique boubou ample de taille unique');
        $response->assertSee('15 000');
    }

    /**
     * Test product not found.
     */
    public function test_non_existent_product_returns_404(): void
    {
        $response = $this->get('/products/non-existent-product');

        $response->assertStatus(404);
    }

    /**
     * Test the products listing page.
     */
    public function test_shop_page_renders_correctly(): void
    {
        $response = $this->get(route('store.shop'));

        $response->assertStatus(200);
        $response->assertSee('Boubou oversized');
        $response->assertSee('15 000');
    }

    /**
     * Test the products listing page filtering by category.
     */
    public function test_shop_page_filters_by_category(): void
    {
        // Filter by Robes
        $response = $this->get(route('store.shop', ['category' => 'Robes']));
        $response->assertStatus(200);
        $response->assertSee('Robe élégante');
        $response->assertDontSee('Gilet contemporain');

        // Filter by Boubous
        $response = $this->get(route('store.shop', ['category' => 'Boubous']));
        $response->assertStatus(200);
        $response->assertSee('Boubou oversized');
        $response->assertDontSee('Robe élégante');
    }

    /**
     * Test the products listing page search functionality.
     */
    public function test_shop_page_searches_by_query(): void
    {
        $response = $this->get(route('store.shop', ['search' => 'oversized']));
        $response->assertStatus(200);
        $response->assertSee('Boubou oversized');
        $response->assertDontSee('Robe élégante');
    }

    /**
     * Test the products listing page sorting.
     */
    public function test_shop_page_sorts_by_price(): void
    {
        // Sort by price asc (Gilet contemporain 8 000 F should appear before Boubou oversized 15 000 F)
        $response = $this->get(route('store.shop', ['sort' => 'price_asc']));
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Gilet contemporain', 'Boubou oversized']);

        // Sort by price desc (Boubou oversized 15 000 F should appear before Gilet contemporain 8 000 F)
        $response = $this->get(route('store.shop', ['sort' => 'price_desc']));
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Boubou oversized', 'Gilet contemporain']);
    }
}
