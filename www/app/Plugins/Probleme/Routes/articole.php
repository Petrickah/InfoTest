<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin-auth')->group(function (){
    Route::resource('/problema', 'ProblemeController');
    Route::get('/problema/{articol}/delete', 'ProblemeController@destroy')->name('problema.destroy');
    Route::get('/solutii', function(){
        return view("Probleme::solutii.index");
    });
});
