<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $tickets = Ticket::with('user')->latest()->get();
        } else {
            $tickets = $user->tickets()->latest()->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $request->user()->tickets()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'abierto',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket creado exitosamente.');
    }

    public function show(Ticket $ticket)
    {
        $user = Auth::user();
        
        // Verifica que el usuario normal solo vea los suyos
        if ($user->role !== 'admin' && $ticket->user_id !== $user->id) {
            abort(403, 'No tienes permiso para ver este ticket.');
        }

        $ticket->load(['messages.user', 'user']);
        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Solo los administradores pueden cambiar el estado del ticket.');
        }

        $request->validate([
            'status' => 'required|in:abierto,en_proceso,cerrado',
        ]);

        $ticket->update(['status' => $request->status]);

        return back()->with('success', 'Estado del ticket fue actualizado correctamente.');
    }
}
