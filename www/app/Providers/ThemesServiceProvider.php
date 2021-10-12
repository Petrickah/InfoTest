<?php

namespace App\Providers;

use App\Themes\Theme;
use Illuminate\Support\ServiceProvider;

class ThemesServiceProvider extends ServiceProvider {

    public $themes = [
        'Snipp'=> \App\Themes\Snipp\Snipp::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $loadedTheme = Theme::load($this->themes)->registerServiceProviders($this->app);
        if(!is_null($loadedTheme) && class_basename($loadedTheme) != Theme::class)
            $loadedTheme->boot();
    }
}
