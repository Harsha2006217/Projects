<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateToken
{
    public function handle($request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Unauthorized: Bearer token missing'], 401);
        }

        $authorizationHeader = $request->header('Authorization');
        $token = $this->parseBearerToken($authorizationHeader);

        if (!$token) {
            return response()->json(['message' => 'Unauthorized: Invalid Bearer token format'], 401);
        }

        return $next($request);
    }

    protected function parseBearerToken($authorizationHeader)
    {
        if (strpos($authorizationHeader, 'Bearer ') === 0) {
            return substr($authorizationHeader, 7);
        }

        return null;
    }
}

