<?php

namespace App\Plugins\UserRoles;

use App\Plugins\Plugin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\View;

class UserRolesPlugin extends Plugin {
    protected static $plugin;
    public $serviceProviders = [
        \App\Plugins\UserRoles\Providers\RolesProvider::class,
        \App\Plugins\UserRoles\Providers\RouteServiceProvider::class,
    ];

    public $dependencies = [
        'Meniu' => \App\Plugins\Meniu\MeniuPlugin::class
    ];
    public $loadedDependencies;

    public function registerPlugin(Application &$app) {
        parent::registerPlugin($app);
        foreach (self::$plugin->serviceProviders as $provider) {
            $app->register($provider);
        }
    }

    public static function load() {
        if(is_null(self::$plugin)) {
            self::$plugin = new UserRolesPlugin;

            if(array_key_exists('Meniu', self::$plugin->dependencies)) {
                /**
                 * @var MeniuPlugin $meniuPlugin
                 */
                $meniuPlugin = self::$plugin->loadedDependencies['Meniu'] = self::$plugin->dependencies['Meniu']::load();
                $meniuPlugin->AddMenuItems('MainMenu', [
                    $meniuPlugin->classes['MenuItem']::load("Utilizatori", "#utilizatori", $meniuPlugin->classes['Menu']::load('Utilizatori', true)->group([
                        $meniuPlugin->classes['MenuItem']::load('Vezi Utilizatori', '/utilizatori', null, ''),
                    ]), 'mdi-apps')
                ]);
            }
        }
        View::addNamespace('UserRoles', realpath(base_path('app/Plugins/UserRoles/Views')));
        return self::$plugin;
    }
}
