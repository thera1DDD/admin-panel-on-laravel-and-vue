<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', 'https://djigit-language.ru');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,OPTIONS,POST');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept');
        $response->headers->set('Access-Control-Expose-Headers', 'Content-Length, Content-Range');
        return $response;
    }
}
