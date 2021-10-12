<?php

namespace App\Providers;

use App\Models\Postare;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        User::observe('App\Observers\UserObserver');
        Postare::observe('App\Observers\ArticolObserver');
    }
}
