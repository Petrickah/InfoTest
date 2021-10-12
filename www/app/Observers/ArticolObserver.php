<?php

namespace App\Observers;

use App\Models\Categorie;
use App\Models\Keyword;
use App\Models\Postare;
use App\Models\User;

class ArticolObserver {
    public static function slugify($string) {
        $array = explode(' ', $string);
        $slug = "";
        foreach ($array as $key=>$word) {
            $array[$key] = strtolower($word);
            $slug = $slug.'-'.$array[$key];
        }
        return trim($slug, '-');
    }

    public function saving(Postare $post) {
        $post->slug = $this->slugify($post->Titlu);
        $post->Autor = User::all()->where('auth_token', '=', $_COOKIE['token'])->first()->Email;
        if(is_null(Categorie::find($post->Categorie))){
            $categorie = new Categorie();
            $categorie->Denumire = $post->Categorie;
            $categorie->save();
        }
    }
}
