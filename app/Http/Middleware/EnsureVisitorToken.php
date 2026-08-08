<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class EnsureVisitorToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('visitor_token');

        if (!$token) {
            $token = Str::uuid()->toString();
            // Queue cookie for 1 year (minutes)
            Cookie::queue('visitor_token', $token, 60 * 24 * 365);
        }

        $request->merge(['visitor_token' => $token]);

        return $next($request);
    }
}
