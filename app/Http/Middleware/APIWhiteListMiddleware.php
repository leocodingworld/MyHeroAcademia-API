<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class APIWhiteListMiddleware
{
	private $whitelist = [
		"localhost",
		"192.168.1.91",
		"" // Incluir IP principal
	];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		if(!in_array($request -> ip(), $this -> whitelist)){
			abort(403, "Acceso Denegado");
		}

        return $next($request);
    }
}
