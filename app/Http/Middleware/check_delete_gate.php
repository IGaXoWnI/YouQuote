<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class check_delete_gate
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
        if (Gate::denies("delete_citation", $citation)) {
            return response()->json([
                "message" => "You don't have permission to delete this citation."
            ], 403);
        }

        return $next($request);
    }
}
