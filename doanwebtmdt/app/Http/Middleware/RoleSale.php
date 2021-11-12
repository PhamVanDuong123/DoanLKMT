<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleSale
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
        if($request->user()->permission!=3 && $request->user()->permission!=1){
            return redirect('/admin');
        }
        return $next($request);
    }
}
