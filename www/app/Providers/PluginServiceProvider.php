<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider {
    public $loadedPlugins = [];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $plugins = include base_path('app/Plugins/plugins.php');
        foreach ($plugins as $key=> $plugin) {
            $this->loadedPlugins[$key] = $plugin::load()->registerPlugin($this->app);
        }
    }
}
