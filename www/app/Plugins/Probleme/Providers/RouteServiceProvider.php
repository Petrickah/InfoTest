<?php
namespace App\Plugins\Probleme\Providers;

use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Plugins\Probleme\Controllers';

    private $routes = [
        'app/Plugins/Probleme/Routes/articole.php',
        'app/Plugins/Probleme/Routes/categorii.php'
    ];

    protected function mapWebRoutes() {
        foreach ($this->routes as $route) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }
}
