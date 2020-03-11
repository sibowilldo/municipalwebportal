<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (! $request->user()->hasAnyRole($roles)) {
            abort(403, "You're not unauthorized to perform this action.");
        }
        return $next($request);
    }
}
