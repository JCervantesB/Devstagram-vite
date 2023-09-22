<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckBlockedUntil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtiene el usuario autenticado desde el request
        $user = $request->user();

        // Verifica si el usuario existe y si tiene una hora en blocked_until configurada
        if ($user && $user->blocked_until) {
            // Obtiene la hora actual
            $now = Carbon::now();
            
            // Compara la hora actual con la hora en blocked_until
            if ($now->gt($user->blocked_until)) {
                // La cuenta no está bloqueada, permite el acceso
                return $next($request);
            } else {
                // La cuenta está bloqueada, redirige o muestra un mensaje de error
                return redirect()->route('login')->with('mensaje', 'Tu cuenta ha sido bloqueada debido a demasiados intentos fallidos. Inténtalo nuevamente en 30 minutos.');
            }
        }

        // Si no hay bloqueo configurado, permite el acceso
        return $next($request);
    }
}
