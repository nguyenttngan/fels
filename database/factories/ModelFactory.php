<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role' => 'user',
        'avatar' => $faker->name,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(20),
    ];
});

$factory->define(App\Models\Word::class, function (Faker\Generator $faker) {
    return [
        'word' => $faker->text(10),
    ];
});

$factory->define(App\Models\Lesson::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 5),
    ];
});

$factory->define(App\Models\Lesson::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 5),
    ];
});
