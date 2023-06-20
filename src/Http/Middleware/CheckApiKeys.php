<?php

namespace ReesMcIvor\ApiAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use ReesMcIvor\ApiAuth\Models\ApiKey;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKeys
{

    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('x-api-key');
        $secret = $request->header('x-api-secret');

        $apiKey = ApiKey
            ::where('key', $key)
            ->where('secret', $secret)
            ->whereDate('expires_at', '>', now())
            ->first();

        if (!$apiKey) {
            return response()->json(['error' => 'Invalid API keys'], 401);
        }

        return $next($request);
    }
}
