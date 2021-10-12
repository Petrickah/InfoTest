<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin-auth')->prefix('categorie')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', 'CategorieController@index')->name('categorie.index');
        Route::post('/',  'CategorieController@save')->name('categorie.save');
    });
    Route::get('/adauga', 'CategorieController@create')->name('categorie.create');
    Route::put('/{categorie}', 'CategorieController@update')->name('categorie.update');
    Route::get('/{categorie}/edit', 'CategorieController@edit')->name('categorie.edit');
    Route::get('/{categorie}/delete', 'CategorieController@destroy')->name('categorie.destroy');
});
