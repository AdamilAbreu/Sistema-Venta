<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está logueado y es un admin
        if (session('role') === 'admin') {
            // Si es admin, redirigir a otra página (puedes redirigir a donde desees)
            return redirect()->route('usuarios.inicio');  // Redirigir al inicio
        }

        return $next($request); 
    }
}
