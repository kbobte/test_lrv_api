<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		// return $next($request)
		  // ->header('Access-Control-Allow-Origin', '*')
		  // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
		  // ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');
		  
		$domains = ['http://localhost:8081/'];
		if(isset($request->server()['HTTP_ORIGIN'])){
			$origin = $request->server()['HTTP_ORIGIN'];
			if(in_array($origin, $domains)) {
				header('Access-Control-Allow-Origin: ' . $origin);
				header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
			}
		}
		
		return $next($request);
    }
}
