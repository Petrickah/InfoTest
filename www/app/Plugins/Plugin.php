<?php


namespace App\Plugins;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\ServiceProvider;

/**
 * Class Plugin
 * @package App\Plugins
 * @var Plugin $plugin
 * @var NamespacedClass[] $classes
 * @var NamespacedClass[] $dependencies
 * @var Plugin[] $loadedDependencies
 * @var ServiceProvider[] $serviceProviders
 */
class Plugin extends BaseController {
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    protected static $plugin;
    public $serviceProviders = [];
    public $classes = [];
    public $dependencies = [];
    public $loadedDependencies = [];
    protected function __construct() {}
    public static function load() {
        if(is_null(self::$plugin)) {
            self::$plugin = new Plugin();
        }
        return self::$plugin;
    }
    public function registerPlugin(Application &$app) {  }
}
