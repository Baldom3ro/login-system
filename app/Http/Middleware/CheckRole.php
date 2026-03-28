<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Si el usuario no tiene el rol exigido, mostramos error 403
        if ($request->user()->role !== $role) {
            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }
}
