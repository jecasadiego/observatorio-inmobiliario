<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UsuarioAprobado
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->estado == User::ESTADO_RECHAZADO) {
                return redirect('/dashboard')->with('error', 'Su usuario no ha sido aprobado.');
            } elseif ($user->estado == User::ESTADO_PENDIENTE) {
                return redirect('/dashboard')->with('error', 'Su usuario está en proceso de aprobación.');
            }
        }

        return $next($request);
    }
}
