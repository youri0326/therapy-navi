<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticate extends Authenticate
{
    protected function redirectTo($request)
    {
        $user = Auth::user();
        $authority = $user->authority;

        if (! $request->expectsJson()) {
            if ($authority === 0) {
                return route('customer.login');
            } else {
                return route('admin.login');
            }
        }
    }
}
