<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        Log::info( "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" . route('login') );
        if (! $request->expectsJson()) {
            Log::info( "=========================================" . route('login') );
            return route('login');
        }
    }
}
