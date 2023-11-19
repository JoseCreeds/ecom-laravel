<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddAuthTokenToHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Vérifier si user authentificated
        if($request->user() && $token = $request->user()->currentAccessToken()) {
            //Ajoutez le jeton au header de la requête sortante
            $request->headers->set('Authorization', 'Bearer' . $token->plainTextToken);
        }
        return $next($request);
    }
}
