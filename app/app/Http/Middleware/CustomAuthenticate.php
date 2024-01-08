<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticate extends Authenticate
{
    protected function redirectTo($request)
    {
        // $user = Auth::user();
        // $authority = $user->authority;

        if (! $request->expectsJson()) {
            $pathInfo = $request->path();
            if ($pathInfo === '/admins' || $pathInfo === '/admins/*') {
                return route('admin.login');
            } else {
                return route('customer.login');
                
            }
        }
    }
}
