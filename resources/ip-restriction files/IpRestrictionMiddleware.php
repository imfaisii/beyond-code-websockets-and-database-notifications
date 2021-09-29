<?php

namespace App\Http\Middleware;

use App\Models\Iprestriction;
use Closure;
use Illuminate\Http\Request;

class IpRestrictionMiddleware
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
        if (Iprestriction::where('address', \Request::ip())->exists())
            return $next($request);
        return abort(403);
    }
}
