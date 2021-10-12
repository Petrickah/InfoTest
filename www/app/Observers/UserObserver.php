<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;

class UserObserver {
    public function saved(User $user) {
        $user->role()->attach(Role::all()->find('Student'));
    }
}
