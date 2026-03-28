<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileDesignTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_edit_view_loads_with_dashboard_layout()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertSee('Mi Cuenta');
        $response->assertSee('bg-[#11131a]'); // Main cards
        $response->assertSee('bg-[#0a0c10]'); // Input fields
        $response->assertSee('Configuración de Perfil'); // Page title
    }

    public function test_dashboard_header_has_clickable_profile_link()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('href="' . route('profile.edit') . '"', false);
        $response->assertSee($user->name);
    }
}
