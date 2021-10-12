<?php


namespace App\Themes\Snipp\Providers;

use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Themes\Snipp\Controllers';
    protected function mapWebRoutes() {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('app/Themes/Snipp/Routes/web.php'));
    }
}
