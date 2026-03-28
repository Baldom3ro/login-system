<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;

class TicketMessageController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        if ($request->user()->role !== 'admin' && $ticket->user_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para responder a este ticket.');
        }

        $ticket->messages()->create([
            'user_id' => $request->user()->id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}
