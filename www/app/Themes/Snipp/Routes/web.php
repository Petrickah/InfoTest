<?php

use App\Models\User;
use App\Plugins\Probleme\Models\Solutie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', 'SnippController@index');
Route::get('/probleme/{problem}', function ($problem) {
    \App\Themes\Snipp\Snipp::$homeRoute = "../themes/snipp/";
    return view("Theme::problem")->with([
        'title' => 'InfoTest - Platforma de evaluare a solutiilor unor probleme',
        "problemID"=>$problem
    ]);
});

Route::get('/probleme/{problema}/score', function($problema) {
    \App\Themes\Snipp\Snipp::$homeRoute = "../../themes/snipp/";
    return view("Theme::score")->with([
        'title' => 'InfoTest - Platforma de evaluare a solutiilor unor probleme',
        "problemID"=>$problema
    ]);
});

Route::get('/probleme/{problema}/upload', function($problema) {
    \App\Themes\Snipp\Snipp::$homeRoute = "../../themes/snipp/";
    return view("Theme::upload")->with([
        'title' => 'InfoTest - Platforma de evaluare a solutiilor unor probleme',
        "problemID"=>$problema
    ]);
});

Route::post('/probleme/{problema}/upload', function(Request $request, $problema){
    $validator = Validator::make($request->all(), []);
    $base_dir = '/opt/solutions/';
    $file = $request->file('solutie');
    $targetFile = $base_dir . basename($file->getClientOriginalName());
    $fileType = strtolower($file->getClientOriginalExtension());
    if(!file_exists($targetFile) && $fileType == 'c') {
        if(move_uploaded_file($file->getRealPath(), $targetFile)) {
            if(!is_null(Cookie::get('token'))) {
                $entryFile = fopen("/opt/solutions/entry.txt", "w");
                $token = Cookie::get('token');
                fwrite($entryFile, "USER $token\nPROBLEM $problema\nDEFINE <solution> AS <user>_<problem>.c\nEVAL <solution> <problem>/stages.txt");
                fclose($entryFile);

                $evalFile = '/opt/solutions/'.Cookie::get('token').'_'.'eval.log';
                
                do {
                    if(file_exists($evalFile)) {
                        sleep(3);
                        $eval = file($evalFile);
                        $solutie = new Solutie;
                        foreach ($eval as $key=>$line) {
                            if(strstr($line, "Total score obtinut:")) {
                                $solutie->score = trim(explode(":", $line)[1]);
                            } else $validator->getMessageBag()->add("line_$key", $line);
                        }
                        $solutie->utilizator = User::all()->where('auth_token', '=', Cookie::get('token'))->first()->Email;
                        $solutie->problema = $problema;
                        $solutie->save();
                        return redirect("/probleme/$problema/score")->withErrors($validator)->withInput();
                    }
                } while(true);
            } else $validator->getMessageBag()->add('not_logged_in', "Nu sunteti connectat ca utilizator.");
        } else $validator->getMessageBag()->add('file_not_uploaded', "Acest fisier nu a fost uploadat.");
    } else if($fileType != 'c') $validator->getMessageBag()->add('file_not_c', "Acest fisier nu este unul de tip C");
    else $validator->getMessageBag()->add('file_exists', "Acest fisier nu a fost inca evaluat");
    return redirect("/probleme/$problema")->withErrors($validator)->withInput();
});