<?php

namespace App\Http\Middleware;
use Auth;
use Illuminate\Support\Facades\Route;
use Closure;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->hasAnyRoles(['Admin','Nhân viên'])){
            return $next($request);
        }
        return redirect('/');
        // return $next($request);
    }
}
