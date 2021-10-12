<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class UserTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!isset($_COOKIE['token'])) return redirect('admin/login');
        $user = \App\Models\User::all()->where('auth_token', '=', $_COOKIE['token']);
        if(!isset($user)) return redirect('admin/register');

        return $next($request);
    }
}
