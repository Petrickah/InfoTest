<?php

namespace App\Plugins\UserRoles\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class RolesProvider extends ServiceProvider {
    private function createRole($role, $desc) {
        $adminRole = DB::table('roles')->where('role', '=', $role)->first();
        if(is_null($adminRole) || empty($adminRole)) {
            Role::create([
                'role' => $role,
                'descriere' => $desc
            ])->save();
        }
    }
    public function boot() {
        $this->createRole('Admin', 'Rol principal de administrare a platformei');
        $this->createRole('Teacher', 'Rol destinat profesorilor');
        $this->createRole('Student', 'Rol destinat elevilor/studentilor');
    }
}