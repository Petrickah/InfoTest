<?php

namespace App\Plugins\AdminUser;

use App\Models\Role;
use App\Models\User;
use App\Plugins\Plugin;
use Illuminate\Contracts\Foundation\Application;

class AdminUserPlugin extends Plugin {
    protected static $plugin;

    public $serviceProviders = [
        \App\Plugins\AdminUser\Providers\UserProvider::class
    ];

    public $depedencies = [
        \App\Plugins\UserRoles\UserRolesPlugin::class
    ];

    public function registerPlugin(Application &$app) {
        parent::registerPlugin($app);
        foreach(self::$plugin->serviceProviders as $provider) {
            $app->register($provider);
        }
        return self::$plugin;
    }

    public static function load() {
        if(is_null(self::$plugin)) {
            self::$plugin = new AdminUserPlugin();
            $adminUser = User::find('admin@infotest.ro');
            if(!empty($adminUser) && is_null($adminUser->role()->find('Admin', ['role']))) {
                $adminUser->role()->attach(Role::all()->find('role', 'Admin'));
            }
        }
        return self::$plugin;
    }
}
