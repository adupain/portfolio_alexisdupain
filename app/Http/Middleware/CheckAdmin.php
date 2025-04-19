<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié et s'il a le rôle 'admin'
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            // Redirige vers la page d'accueil avec un message d'erreur
            return redirect('/home')->with('error', 'Vous devez être administrateur pour accéder à cette page.');
        }

        return $next($request);
    }
}
