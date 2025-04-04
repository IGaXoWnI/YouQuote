<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class userMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $citation = $request->route('citation');

        // Check if the gate denies access to the citation
        if (Gate::denies("user_permissions", $citation)) {
            return response()->json([
                "message" => "You don't have permission to manage this citation."
            ], 403);
        }

        return $next($request);
    }
}
