<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function (){
    Route::prefix('admin')->group(function () {
        Route::post('/', 'Admin\LoginController@submit')->name('login.submit');
        Route::get('/login', 'Admin\LoginController@login')->name('login.login');
        Route::get('/register', 'Admin\LoginController@register')->name('login.register');
    });
    Route::apiResource('/user', 'Resources\UserController');
    Route::middleware('admin-auth')->prefix('admin')->group(function () {
        Route::get('/', function () {return view('admin');})->name('admin.index');
        Route::get('/logout', 'Admin\LoginController@logout')->name('login.logout');
    });
});
