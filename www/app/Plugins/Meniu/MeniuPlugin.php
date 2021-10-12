<?php

namespace App\Plugins\Meniu;

use App\Plugins\Meniu\Classes\Menu;
use App\Plugins\Plugin;
use someNamespaceA\NamespacedClass;

/**
 * Class MeniuPlugin
 * @package App\Plugins\Meniu
 * @property Menu $menu
 * @var MeniuPlugin $plugin
 * @var NamespacedClass[] $classes
 */
class MeniuPlugin extends Plugin{
    protected static $plugin;
    public $classes = [
        'Menu' => \App\Plugins\Meniu\Classes\Menu::class,
        'MenuItem' => \App\Plugins\Meniu\Classes\MenuItem::class
    ];
    private $menu;
    public static function load() {
        if(is_null(self::$plugin)) {
            self::$plugin = new MeniuPlugin();
            self::$plugin->menu = self::$plugin->classes['Menu']::load('MainMenu');
            self::$plugin->menu->group([
                self::$plugin->classes['MenuItem']::load("Dashboard", "/admin", null)
            ]);
        }
        return self::$plugin;
    }
    public function AddMenuItems($title, $items) {
        foreach ($items as $item) {
            self::$plugin->menu::addMenuItem($title, $item);
        }
        return $this;
    }
}
