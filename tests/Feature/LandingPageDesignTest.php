<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageDesignTest extends TestCase
{
    public function test_welcome_page_loads_with_premium_design()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Soporte', false);
        $response->assertSee('Pro', false);
        $response->assertSee('Soluciona', false);
        $response->assertSee('Problemas Ya', false);
        $response->assertSee('Seguridad', false);
        $response->assertSee('Roles', false);
        $response->assertSee('Gestión', false);
        $response->assertSee('Cómo Funciona', false);
        $response->assertSee('Crear Ticket', false);
        $response->assertSee('Seguimiento', false);
        $response->assertSee('Resolución', false);
    }
}
