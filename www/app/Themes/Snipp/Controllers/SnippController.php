<?php
namespace App\Themes\Snipp\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Postare;
use App\Plugins\Probleme\Models\Probleme;
use Illuminate\Support\Facades\View;

class SnippController extends Controller {
    public function index() {
        $probleme = Probleme::all()->toArray();
        $problemeArray = [];
        foreach($probleme as $problema) {
            $probl = [];
            $postare = Postare::all()->find($problema['slug']);
            $probl['image'] = substr($problema['thumbnail'], strlen("/var/www/html/public"), strlen($problema['thumbnail']));
            preg_match("/(<p .*>.*<\/p>)+/", $postare->Continut, $matches);
            $probl['description'] = $matches[1];
            preg_match("/[\d]{0,4}\-[\d]{0,2}\-[\d]{0,2}/", $postare->created_at, $matches);
            $probl['date'] = $matches[0];
            $probl['autor'] = $postare->autor->Username;
            $nume = $problema['nume'];
            $probl['page'] = "/probleme/$nume";
            $problemeArray[] = $probl;
        }
        //dd($problemeArray);
        return View::make('Theme::welcome')->with(
            [
                'title' => 'InfoTest - Platforma de evaluare a solutiilor unor probleme',
                'message' => 'Hello, world!',
                'probleme' => $problemeArray
            ]
        );
    }
}
