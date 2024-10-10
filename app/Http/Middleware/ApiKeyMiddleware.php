<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the API key from the request header
        $apiKey = $request->header('Api-Key');  // or 'Authorization'

        // Define your valid API key(s)
        $validApiKey = env('API_KEY', 'your_default_api_key');  // Store the key in .env

        // Check if the API key matches the expected key
        if ($apiKey !== $validApiKey) {
            // If the key is invalid, return a 401 Unauthorized response
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // If the key is valid, proceed with the request
        return $next($request);
    }
}
