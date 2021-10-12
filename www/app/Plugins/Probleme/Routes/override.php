<?php

use App\Http\Controllers\Admin\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::get('admin', function() {
    $user = User::all()->where('auth_token', '=', Cookie::get('token'))->first();
    if(isset($user) && !is_null($user)) {
        $role = $user->role[0];
        if(isset($role) && !is_null($role))
            if($role->role === "Admin" || $role->role === "Teacher")
                return view('admin');
    }
    return redirect('/');
});
