<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class CheckRole
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
        if ($user = Sentinel::getUser())
        {
            if (!$user->inRole('admin'))
            {
               
                return redirect()->back()->with('failed','Permission Denied');
            }
        }
        return $next($request);
    }
}
