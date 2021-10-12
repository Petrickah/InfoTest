<?php 

namespace App\Plugins\AdminUser\Providers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Webpatser\Uuid\Uuid;

class UserProvider extends ServiceProvider {
    public function boot() {
        $adminUser = DB::table('useri')->where('Username', '=', 'Administrator')->first();
        if(is_null($adminUser) || empty($adminUser)){
            $admin = User::create([
                'Username'=>'Administrator',
                'Email'=>'admin@infotest.ro',
                'Password'=>'Admin',
                'auth_token'=>Uuid::generate(4)
            ]);
            $admin->Password = "Admin";
            $admin->save();
        }
    }
}