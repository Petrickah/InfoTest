<?php
namespace App\Plugins\UserRoles\Providers;

use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Plugins\UserRoles\Controllers';

    private $routes = [
        'app/Plugins/UserRoles/Routes/userroutes.php'
    ];

    protected function mapWebRoutes() {
        foreach ($this->routes as $route) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }
}
