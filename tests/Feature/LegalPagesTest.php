<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    /**
     * Test that the Politique de retour page renders correctly.
     */
    public function test_politique_de_retour_renders_correctly(): void
    {
        $response = $this->get(route('store.retour'));

        $response->assertStatus(200);
        $response->assertSee('Politique de Retour');
        $response->assertSee('Remboursement');
        $response->assertSee('14 jours');
    }

    /**
     * Test that the Mentions légales page renders correctly.
     */
    public function test_mentions_legales_renders_correctly(): void
    {
        $response = $this->get(route('store.mentions'));

        $response->assertStatus(200);
        $response->assertSee('Mentions Légales');
        $response->assertSee('Paul TOGNON');
    }

    /**
     * Test that the CGV page renders correctly.
     */
    public function test_cgv_renders_correctly(): void
    {
        $response = $this->get(route('store.cgv'));

        $response->assertStatus(200);
        $response->assertSee('Conditions Générales de Vente');
        $response->assertSee('FedaPay');
    }

    /**
     * Test that the Données privées page renders correctly.
     */
    public function test_donnees_privees_renders_correctly(): void
    {
        $response = $this->get(route('store.donnees'));

        $response->assertStatus(200);
        $response->assertSee('Données Privées');
        $response->assertSee('Confidentialité');
    }
}
