<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isTeacher
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
        if (Auth::check()) {
            if(Auth::user()->teacher == 1 || Auth::user()->admin == 1) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
