<?php


namespace App\Themes;

use App\Models\Setare;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\ServiceProvider;

/**
 * Class Theme
 * @package App\Themes
 * @var Theme $themeController
 * @property string $themeName
 * @property ServiceProvider[] $serviceProviders
 */
class Theme extends BaseController {
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    protected static $themeController = null;
    public static $themeName = '';
    public static $serviceProviders = [];

    public function registerServiceProviders(Application &$app) { return self::$themeController; }
    public function boot() {}
    public static function load(array $themes) {
        $theme = Setare::all()->where('Obtiune', '=', 'current_theme');
        if(!$theme->isEmpty() && is_null(self::$themeController)) {
            self::$themeName = $theme->first()->Valoare;
            self::$themeController = new $themes[self::$themeName];
            return self::$themeController;
        }
        return new Theme();
    }
}
