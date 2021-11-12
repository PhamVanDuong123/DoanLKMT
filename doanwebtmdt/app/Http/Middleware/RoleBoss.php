<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleBoss
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
        if ($request->user()->permission != 1) {
            if ($request->user()->permission == 2)
                return redirect('/admin/user');
            if ($request->user()->permission == 3)
                return redirect('/admin');
        }
        return $next($request);
    }
}
