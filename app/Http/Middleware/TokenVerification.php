<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        // Return unauthorized response if token is missing
        if (! $token) {
            return ResponseHelper::Out(false, 'Token missing', 401);
        }

        $result = JWTToken::verifyToken($token);

        // Ensure $result is an object before accessing its properties
        if (! is_object($result) || empty($result->email)) {
            return ResponseHelper::Out(false, 'Unauthorized', 401);
        }

        // Set user details in headers
        $request->headers->set('email', $result->email);
        $request->headers->set('id', $result->id ?? null);
        $request->headers->set('role', $result->role ?? null);

        return $next($request);
    }
}
