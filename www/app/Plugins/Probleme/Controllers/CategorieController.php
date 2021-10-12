<?php

namespace App\Plugins\Probleme\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller {
    public function index(){
        return view('Probleme::categorie.index');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'Denumire'=>'required',
        ]);
        if($validator->fails()) {
            return redirect('/categorie/adauga')
                ->withErrors($validator)
                ->withInput();
        }

        $post = $request->all(['Denumire', 'Descriere']);
        $keywords = $request->all(['keywords'])['keywords'];
        $categorie = \App\Models\Categorie::create($post);
        if(!is_null($keywords)) {
            $kwords = explode(', ', $keywords);
            foreach ($kwords as $kw) {
                $categorie->keyword()->create(['Keyword'=>$kw, 'postare_slug'=>null]);
            }
        }
        $categorie->Descriere = $post['Descriere'];
        $categorie->save();

        return redirect('/categorie');
    }

    function create() {
        return view('Probleme::categorie.edit')
            ->with('categorie', new \App\Models\Categorie())
            ->with('kwords', '')
            ->with('method', 'POST');
    }

    function edit(string $categorie){
        $kwords = ''; $keywords = \App\Models\Categorie::find($categorie)->keyword
            ->where('postare_slug', '=', null)->all();
        foreach($keywords as $keyword){
            $kwords = $kwords . ', ' . $keyword->Keyword;
        }
        return view('Probleme::categorie.edit')
            ->with('categorie', \App\Models\Categorie::find($categorie))
            ->with('kwords', trim($kwords, ', '))
            ->with('method', 'PUT');
    }

    function destroy(string $categorie){
        $category = \App\Models\Categorie::find($categorie);
        /**
         * @var Keyword $keyword
         */
        try {
            foreach ($category->keyword as $keyword) {
                $keyword->delete();
            }
            $category->delete();
        } catch(\Exception $e) {
            return redirect('categorie')
                ->withErrors($e->getMessage());
        }
        return redirect('categorie');
    }

    function update(Request $request, string $categorie) {
        $validator = Validator::make($request->all(), [
            'Denumire'=>'required',
        ]);
        if($validator->fails()) {
            return redirect('/categorie/'.$categorie.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $put = $request->all();
        $category = \App\Models\Categorie::find($categorie);
        $category->Denumire = $put['Denumire'];
        $category->Descriere = (isset($put['Descriere']))?$put['Descriere']:null;

        $kw = [];
        foreach ($category->keyword->all() as $word) {
            $kw[] = $word->Keyword;
        }
        $keywords = explode(', ', $put['keywords']);

        foreach ($add = array_diff($keywords, $kw) as $word) {
            $category->keyword()->create([
                    'postare_slug' => null,
                    'Keyword' => $word]
            );
        }
        foreach ($delete = array_diff($kw, $keywords) as $word) {
            $kw = Keyword::all()->where('Keyword', '=', $word);
            foreach ($kw as $w) {
                try {
                    $w->delete();
                } catch (\Exception $e) {
                    return redirect('categorie')->withErrors($e->getMessage());
                }
            }
        }

        $category->save();
        return redirect('categorie');
    }
}
