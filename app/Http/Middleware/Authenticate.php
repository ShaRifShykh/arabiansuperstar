<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Route::is("admin.*")) {
                return route('home');
            } elseif (Route::is("api.*")) {
                return route('authFailed');
            }
            return route('home');
        }
    }
}
