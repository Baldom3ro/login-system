<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        $tickets = \App\Models\Ticket::with('user')->latest()->get();
        $metrics = [
            'total' => $tickets->count(),
            'abiertos' => $tickets->where('status', 'abierto')->count(),
            'en_proceso' => $tickets->where('status', 'en_proceso')->count(),
            'cerrados' => $tickets->where('status', 'cerrado')->count(),
        ];
        return view('dashboard', compact('tickets', 'metrics'));
    } else {
        $tickets = $user->tickets()->latest()->get();
        return view('dashboard', compact('tickets'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/sessions', [ProfileController::class, 'destroyOtherSessions'])->name('profile.sessions.destroy');

    // Sistema de tickets
    Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [App\Http\Controllers\TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [App\Http\Controllers\TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [App\Http\Controllers\TicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{ticket}', [App\Http\Controllers\TicketController::class, 'update'])->name('tickets.update');

    // Mensajes de tickets
    Route::post('/tickets/{ticket}/messages', [App\Http\Controllers\TicketMessageController::class, 'store'])->name('ticket.messages.store');

    // Rutas EXCLUSIVAS para administradores administradas en Dashboard
});

require __DIR__.'/auth.php';
