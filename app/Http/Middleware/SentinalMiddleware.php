<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class SentinalMiddleware
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
        if (!Sentinel::check()) { 
            
            $url = url()->current();
            $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
            return redirect()->route('login')->with('prev-route', $route);
        }
        return $next($request);
    }
}
