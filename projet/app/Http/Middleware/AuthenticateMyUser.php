<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMyUser
{
    /**
     * Handle an incoming request.
     * Intercepte chaque requête entrante pour vérifier si l'utilisateur est connecté.
	 *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if ( $request->session()->missing('user') )
			return to_route('view_signin');

		$request->user = $request->session()->get('user');
        $request->user->refresh();
        return $next($request);
    }
}
