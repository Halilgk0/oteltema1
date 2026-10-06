<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Respond with 404 rather than a redirect so the panel's existence isn't revealed.
        if (!$request->user() || !$request->user()->is_admin) {
            abort(404);
        }

        return $next($request);
    }
}
