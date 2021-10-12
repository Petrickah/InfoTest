<?php


namespace App\Plugins\Probleme;

use App\Plugins\Meniu\MeniuPlugin;
use App\Plugins\Plugin;
use App\Models\Postare;
use App\Plugins\Probleme\Models\Probleme;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ProblemePlugin
 * @package App\Plugins\Articole
 * @var ProblemePlugin $plugin
 * @var ServiceProvider[] $serviceProviders
 * @var Plugin[] $dependencies
 * @var Plugin[] $loadedDependencies
 */
class ProblemePlugin extends Plugin {
    protected static $plugin;
    private $problemeDatabase;
    public $serviceProviders = [
        \App\Plugins\Probleme\Providers\RouteServiceProvider::class
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
        return self::$plugin;
    }
    public static function getProblemeFromPostare(Postare $postare) {
        return Probleme::all()->where('slug', '=', $postare->slug)->first();
    }
    public static function load() {
        if(is_null(self::$plugin)) {
            self::$plugin = new ProblemePlugin();
            self::$plugin->problemeDatabase = new ProblemeDatabase();
            self::$plugin->problemeDatabase->boot();

            if(array_key_exists('Meniu', self::$plugin->dependencies)) {
                /**
                 * @var MeniuPlugin $meniuPlugin
                 */
                $meniuPlugin = self::$plugin->loadedDependencies['Meniu'] = self::$plugin->dependencies['Meniu']::load();
                $meniuPlugin->AddMenuItems('MainMenu', [
                    $meniuPlugin->classes['MenuItem']::load("Probleme", "#page-layouts", $meniuPlugin->classes['Menu']::load('Probleme', true)->group([
                        $meniuPlugin->classes['MenuItem']::load("Categorii", "/categorie", null, ''),
                        $meniuPlugin->classes['MenuItem']::load('Vezi problema', '/problema', null, ''),
                        $meniuPlugin->classes['MenuItem']::load('Adauga problema', '/problema/create', null, ''),
                    ]), 'mdi-apps'),
                    $meniuPlugin->classes['MenuItem']::load("Solutii", "/solutii", $meniuPlugin->classes['Menu']::load("Solutii", false))
                ]);
            }
            View::addNamespace('Probleme', realpath(base_path('app/Plugins/Probleme/Views')));
        }
        return self::$plugin;
    }
}
