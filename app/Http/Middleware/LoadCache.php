<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Config;

class LoadCache
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
        if(!$request->session()->has('config')) {
            $request->session()->put('config', Config::all());
        }

        return $next($request);
    }
}
