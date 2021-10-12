<?php

namespace App\Plugins\Meniu\Classes;

class Menu {
    /**
     * @var bool $is_submenu
     */
    public $is_submenu = false;
    /**
     * @var string $nume
     */
    public $nume = '';
    /**
     * @var Menu[] $menus
     */
    private static $menus = [];
    /**
     * @var MenuItem[] $items
     */
    private $items = [];
    /**
     * @var MenuItem $item
     */
    public $item = null;

    private function __construct($nume, $is_submenu = false){
        $this->nume = $nume;
        $this->is_submenu = $is_submenu;
    }

    /**
     * @param $nume
     * @param bool $is_submenu
     * @return Menu
     */
    public static function load($nume, $is_submenu = false) {
        self::$menus[$nume] = new Menu($nume, $is_submenu);
        return self::$menus[$nume];
    }
    public function group($group = []) {
        if(!empty($this->nume) && array_key_exists($this->nume, self::$menus)) {
            foreach ($group as $item) {
                if (!is_null(self::$menus[$this->nume])) {
                    self::$menus[$this->nume]->items[] = $item;
                }
            }
            return self::$menus[$this->nume];
        }
        return self::load('MainMenu');
    }
    public static function addMenuItem($nume, MenuItem $item) {
        if(!is_null(self::$menus[$nume])) {
            self::$menus[$nume]->items[] = $item;
        }
    }
    public static function draw($nume) {
        $echo = '';
        if(!is_null(self::$menus[$nume])) {
            if(self::$menus[$nume]->is_submenu) {
                $id = trim(self::$menus[$nume]->item->url, '#');
                $echo = $echo."<div class=\"collapse\" id=\"$id\">";
            }
            $classes = (self::$menus[$nume]->is_submenu)?" flex-column sub-menu":"";
            $echo = $echo."<ul class=\"nav$classes\">";
            foreach(self::$menus[$nume]->items as $item) {
                $echo = $echo . $item->draw();
            }
            $echo = $echo.'</ul>';
            if(self::$menus[$nume]->is_submenu) {
                $echo = $echo.'</div>';
            }
        }
        return $echo;
    }
}
