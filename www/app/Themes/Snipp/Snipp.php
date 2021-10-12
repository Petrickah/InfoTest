<?php

namespace App\Themes\Snipp;

use App\Themes\Theme;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\View;

class Snipp extends Theme {
    public static $themeName = 'Snipp';
    public static $serviceProviders = [
        \App\Themes\Snipp\Providers\RouteServiceProvider::class
    ];
    private static $styles = [];
    private static $scripts = [];
    public static $homeRoute = "/themes/snipp/";

    public function registerServiceProviders(Application &$app) {
        foreach (self::$serviceProviders as $provider)
            $app->register($provider);
        return parent::registerServiceProviders($app);
    }

    public static function script_enqueue($scriptUrl) {
        self::$scripts[] = $scriptUrl;
    }
    public static function style_enqueue($style, $styleUrl) {
        self::$styles[$style] = $styleUrl;
    }
    public static function print_styles() {
        foreach (self::$styles as $key=>$style) { ?>
            <link rel="stylesheet" href="<?php echo self::$homeRoute.self::$styles[$key]; ?>">
        <?php }
    }
    public static function print_scripts() {
        foreach (self::$scripts as $script) { ?>
            <script src="<?php echo self::$homeRoute.$script; ?>"></script>
        <?php }
    }
    private function enqueue_styles() {
        self::style_enqueue("open-iconic-bootstrap","css/open-iconic-bootstrap.min.css");
        self::style_enqueue("animate", "css/animate.css");
        self::style_enqueue("owl-carousel", "css/owl.carousel.min.css");
        self::style_enqueue("owl-theme", "css/owl.theme.default.min.css");
        self::style_enqueue("magnific-popup", "css/magnific-popup.css");
        self::style_enqueue("aos", "css/aos.css");
        self::style_enqueue("ionicons", "css/ionicons.min.css");
        self::style_enqueue("bootstrap-datepicker", "css/bootstrap-datepicker.css");
        self::style_enqueue("jquery-timepicker", "css/jquery.timepicker.css");
        self::style_enqueue("flaticon", "css/flaticon.css");
        self::style_enqueue("icomoon", "css/icomoon.css");
        self::style_enqueue("style", "css/style.css");
    }
    private function enqueue_scripts() {
        self::script_enqueue("js/jquery.min.js");
        self::script_enqueue("js/jquery-migrate-3.0.1.min.js");
        self::script_enqueue("js/popper.min.js");
        self::script_enqueue("js/bootstrap.min.js");
        self::script_enqueue("js/jquery.easing.1.3.js");
        self::script_enqueue("js/jquery.waypoints.min.js");
        self::script_enqueue("js/jquery.stellar.min.js");
        self::script_enqueue("js/owl.carousel.min.js");
        self::script_enqueue("js/jquery.magnific-popup.min.js");
        self::script_enqueue("js/aos.js");
        self::script_enqueue("js/jquery.animateNumber.min.js");
        self::script_enqueue("js/bootstrap-datepicker.js");
        self::script_enqueue("js/scrollax.min.js");
        self::script_enqueue("js/main.js");
    }

    public function boot() {
        View::addNamespace('Theme', realpath(base_path('app/Themes/Snipp/Views')));
        $this->enqueue_styles();
        $this->enqueue_scripts();
        return self::$themeController;
    }
}
