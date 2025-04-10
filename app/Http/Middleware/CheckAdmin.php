<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'administrateur est authentifié (par exemple, en vérifiant une variable de session)
        if (!session()->has('admin_id')) {
            // Si l'administrateur n'est pas authentifié, redirige-le vers la page de connexion
            return redirect('/securedashboard');
        }

        // Si l'administrateur est authentifié, continue l'exécution de la requête
        return $next($request);
    }
}
