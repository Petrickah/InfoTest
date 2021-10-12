<?php

namespace App\Plugins\Meniu\Classes;

class MenuItem {
    private $menu_title = '';
    public $url = '';
    /**
     * @var Menu $menu
     */
    private $menu = null;
    private $icon = 'mdi-home';

    private function __construct($title, $url, $submenu, $icon = 'mdi-home') {
        $this->menu_title = $title;
        $this->url = $url;
        $this->menu = $submenu;
        $this->icon = $icon;
    }

    public static function load($title, $url, $submenu, $icon = 'mdi-home') {
        $item = new MenuItem($title, $url, $submenu, $icon);
        if(!is_null($item->menu)) {
            $item->menu->item = $item;
        }
        return $item;
    }

    public function draw() {
        $echo = '<li class="nav-item">';
        $url = $this->url; $toggle = (!is_null($this->menu) && $this->menu->is_submenu)?'data-toggle="collapse" aria-expanded="false" aria-controls="'.trim($this->url, '#').'"':'';
        $echo = $echo."<a href=\"$url\" class=\"nav-link\" $toggle>";
        $echo = $echo.'<span class="menu-title">'.$this->menu_title.'</span>';
        if(!is_null($this->menu) && $this->menu->is_submenu) {
            $echo = $echo.'<i class="menu-arrow"></i>';
        }
        $echo = $echo.'<i class="mdi menu-icon '.$this->icon.'"></i>';
        $echo = $echo.'</a>';
        if(!is_null($this->menu) && $this->menu->is_submenu) {
            $echo = $echo.$this->menu->draw($this->menu->nume);
        }
        $echo = $echo.'</li>';
        return $echo;
    }
}
