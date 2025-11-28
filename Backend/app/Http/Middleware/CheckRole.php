<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Maneja una solicitud entrante verificando el rol.
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
