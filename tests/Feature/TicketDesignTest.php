<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketDesignTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_index_view_loads_with_dark_theme()
    {
        $user = User::factory()->create(['role' => 'client']);
        
        $response = $this->actingAs($user)->get(route('tickets.index'));

        $response->assertStatus(200);
        $response->assertSee('bg-[#0a0c10]'); // Body background from layout
        $response->assertSee('bg-[#11131a]'); // Card background
        $response->assertSee('Todos los Tickets');
    }

    public function test_ticket_create_view_loads_with_dark_theme()
    {
        $user = User::factory()->create(['role' => 'client']);
        
        $response = $this->actingAs($user)->get(route('tickets.create'));

        $response->assertStatus(200);
        $response->assertSee('bg-[#11131a]'); // Form card background
        $response->assertSee('Nueva Solicitud');
    }

    public function test_ticket_show_view_loads_with_dark_theme()
    {
        $user = User::factory()->create(['role' => 'client']);
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'status' => 'abierto'
        ]);
        
        $response = $this->actingAs($user)->get(route('tickets.show', $ticket));

        $response->assertStatus(200);
        $response->assertSee('bg-[#11131a]'); // Chat container
        $response->assertSee('Test Ticket');
        $response->assertSee('Información del Ticket');
    }
}
