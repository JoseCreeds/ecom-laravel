<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Check if user logged is an admin 
        if (auth()->user()->user_status == 1) {
            //IF yes, continue until the next request
            return $next($request);
        } else {
            //Otherwise, show forbidden
            abort(403);
        }
    }
}
