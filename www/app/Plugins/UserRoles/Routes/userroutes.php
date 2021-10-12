<?php

use Illuminate\Support\Facades\Route;

Route::get("/utilizatori", "UserAdminController@index");
Route::prefix("/utilizator")->group(function (){
    Route::get("/{username}", "UserAdminController@modify");
    Route::post("/{username}", "UserAdminController@save");
});