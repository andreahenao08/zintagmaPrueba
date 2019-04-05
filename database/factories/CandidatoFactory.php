<?php

use App\Candidato;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Candidato::class, function (Faker $faker) {
    return [
        'nombres' => $faker->name,
        'apellidos' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'direccion' => $faker->address,
        'telefono' => $faker->phonenumber,
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'estado' => 'No evaluado',
        'salarioEsperado' => $faker->numberBetween(199,499),
        'experiencia' => $faker->name,
        'remember_token' => Str::random(10),
    ];
});
