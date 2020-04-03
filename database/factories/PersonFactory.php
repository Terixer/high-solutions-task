<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Person::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
        'height' => $faker->numberBetween(100, 200),
        'mass' => $faker->numberBetween(50, 300),
        'hair_color' => $faker->word,
        'skin_color' => $faker->word,
        'eye_color' => $faker->word,
        'birth_year' => $faker->word,
        'gender' => $faker->word,
    ];
});
