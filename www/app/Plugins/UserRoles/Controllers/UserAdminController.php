<?php

namespace App\Plugins\UserRoles\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller {
    public function index() {
        return view("UserRoles::utilizatori");
    }
    public function modify(string $username) {
        $user = User::all()->where("Username", "=", $username)->first();
        if(isset($user)) {
            return view("UserRoles::modify")->with([
                'username'=>$username,
                'nume'=>$user->Nume,
                'prenume'=>$user->Prenume,
                'role'=>$user->role[0]->role
            ]);
        } else return redirect("/admin");
    }
    public function save(Request $request, string $username) {
        $user = User::all()->where("Username", "=", $username)->first();
        if(isset($user)) {
            $user->Username = $request->Username;
            $user->Nume = $request->Nume;
            $user->Prenume = $request->Prenume;
            $oldRoles = $user->role;
            foreach($oldRoles as $old) {
                $user->role()->detach($old->Role);
            }
            $user->role()->attach($request->Role);
            $user->save();
        }
        return redirect("/utilizatori");
    }
}