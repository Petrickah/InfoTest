<?php

/** @var Factory $factory */

use App\Models\User;
use App\Models\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(User::class, function (Faker $faker) {
    return [
        'Email' => $faker->email,
        'Username' => $faker->userName,
        'Nume' => $faker->firstName,
        'Prenume' => $faker->lastName,
        'Password' => password_hash($faker->password, CRYPT_SHA256),
        'auth_token' => bin2hex(openssl_random_pseudo_bytes(30))
    ];
});
