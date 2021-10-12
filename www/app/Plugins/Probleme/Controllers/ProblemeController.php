<?php

namespace App\Plugins\Probleme\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Postare;
use App\Plugins\Probleme\Models\Probleme;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use ZipArchive;

class ProblemeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index() {
        return view('Probleme::articol.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create() {
        return view('Probleme::articol.create');
    }

    private function uploadFile($base_dir, $file, &$validator) {
        //$base_dir = '/opt/solutions/';
        //$file = $request->file('evaluator');
        $targetFile = $base_dir . basename($file->getClientOriginalName());
        $fileType = strtolower($file->getClientOriginalExtension());
        if(!file_exists($targetFile) && $fileType == 'zip') {
            if(move_uploaded_file($file->getRealPath(), $targetFile)) {
                $zip = new ZipArchive;
                $res = $zip->open($targetFile);
                if($res === TRUE) {
                    $zip->extractTo($base_dir);
                    $zip->close();
                    return $targetFile;
                } else $validator->getMessageBag()->add('evaluator_file_unzip', 'File unziping error found.');
            } else $validator->getMessageBag()->add('evaluator_file_upload', 'File upload error found.');
        } else {
            if(!file_exists($targetFile) && ($fileType == 'jpg' || $fileType == 'png')) {
                if(!move_uploaded_file($file->getRealPath(), $targetFile))
                    $validator->getMessageBag()->add('evaluator_file_upload', 'File upload error found.');
                else return $targetFile;
            } else $validator->getMessageBag()->add('evaluator_file_type', 'File type is not zip or image. Or your files already exists.');
        }
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'Titlu'=>'required',
            'Continut'=>'required',
            'Categorie'=>'required',
        ]);
        if($validator->fails()) {
            return redirect('/problema/create')
                ->withErrors($validator)
                ->withInput();
        }

        $targetFile = $this->uploadFile('/opt/solutions', $request->file('evaluator'), $validator);
        if(is_null($targetFile))
            return redirect('/problema/create')
                ->withErrors($validator)
                ->withInput();
        $targetFile = $this->uploadFile('/var/www/html/public/upload/images', $request->file('thumbnail'), $validator);
        if(is_null($targetFile))
            return redirect('/problema/create')
                ->withErrors($validator)
                ->withInput();

        $postare = Postare::create($request->all(['Titlu', 'Continut', 'Categorie']))
            ->updateKeywords($request->all('keywords')['keywords']);
        Probleme::create(['nume'=>$postare->slug, 'location'=>"/opt/solutions/$postare->slug", 'slug'=>$postare->slug, 'thumbnail'=>$targetFile]);

        return redirect('/problema');
    }

    /**
     * Display the specified resource.
     *
     * @param string $postare
     * @return Factory|View|Response
     */
    public function show(string $postare) {
        $keywords = Postare::find($postare)->keyword;
        //dd($keywords->first()->keyword());
        $kwords = '';
        foreach ($keywords as $kw) {
            $kwords = trim($kwords.', '.$kw->Keyword, ', ');
        }
        return view('Probleme::articol.show')
            ->with('postare', Postare::find($postare))
            ->with('kwords', $kwords);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $postare
     * @return Factory|View
     */
    public function edit(string $postare) {
        $keywords = Postare::find($postare)->keyword;
        $kwords = '';
        foreach ($keywords as $kw) {
            $kwords = trim($kwords.', '.$kw->Keyword, ', ');
        }
        return view('Probleme::articol.edit')
            ->with('postare', Postare::find($postare))
            ->with('kwords', $kwords);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $postare
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, string $postare) {
        $validator = Validator::make($request->all(), [
            'Titlu'=>'required',
            'Continut'=>'required',
        ]);
        $articol = Postare::find($postare);
        if($validator->fails()) {
            return redirect('/problema/'.$articol->slug.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $targetFile = $this->uploadFile('/var/www/html/public/upload/images/', $request->file('thumbnail'), $validator);
        if(!is_null($targetFile)) {
            $problema = Probleme::all()->where('nume', '=', $articol->slug)->first();
            $problema->thumbnail = $targetFile;
            $problema->save();
        }
        $articol->fill($request->all())->updateKeywords($request->all('keywords')['keywords'])->save();
        
        return redirect("problema/$articol->slug");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $postare
     * @return RedirectResponse|Redirector|Response
     * @throws Exception
     */
    public function destroy(string $postare)
    {
        Postare::find($postare)->delete();
        return redirect('/problema');
    }
}
