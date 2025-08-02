<?php

namespace Akhilesh\Laradmin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustChangePassword
{
    public function handle(Request $request, Closure $next)
    {
        $u = $request->user();
        if ($u && $u->must_change_password && !$request->routeIs('laradmin.force-password.*')) {
            return redirect()->route('laradmin.force-password.show');
        }
        return $next($request);
    }
}
