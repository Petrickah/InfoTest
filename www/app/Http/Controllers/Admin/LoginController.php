<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {
    public function register(Request $request) {
        return view('forms.register');
    }
    public function login() {
        if(isset($_COOKIE['token']))
            return redirect('admin/logout');
        return view('forms.login');
    }
    public function logout() {
        setcookie('token', null, strtotime('0 Minutes'), '/');
        return redirect('admin/login');
    }
    public function submit(Request $request) {
        $validator = Validator::make($request->all(), [
            'Username' => 'required',
            'Password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::all()->where("Username", "=", ($request->all('Username')['Username']))->first();
        $hash = $user->Password;
        if(isset($user) && password_verify($request->all('Password')['Password'], $hash)){
            $logged_in = $request->all('logged-in')['logged-in'];
            if($logged_in) setcookie('token', $user->auth_token, strtotime('+7 Days'), '/');
            else setcookie('token', $user->auth_token, strtotime('+5 Minutes'), '/');

            return redirect('admin');
        } else {
            if(!isset($user))
                $validator->errors()->add('Email', 'The specified email was not found! Are you registered?');
            else if(!password_verify($request->all('Password')['Password'], $hash))
                $validator->errors()->add('Password', 'The specified password was invalid!');

            return redirect('/admin/login')->withErrors($validator)->withInput();
        }
    }
}
