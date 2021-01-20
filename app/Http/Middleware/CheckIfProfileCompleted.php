<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\RegisterStep2Controller;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckIfProfileCompleted
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
        if (Auth::guest())
        {
            return $next($request);
        }

        else if (Auth::user()->successfully_registered)
        {
            return $next($request);
        }

        else
        {
            return redirect()->action([RegisterStep2Controller::class, 'index']);
        }
    }
}
