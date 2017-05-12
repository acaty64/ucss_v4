<?php

use App\Acceso;
use App\MenuType;
use App\Type;
use App\User;

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
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Acceso::class, function (Faker\Generator $faker, $attributes) {
    return [
        'user_id'   => function ()
        {
            return factory(User::class)->random()->id;
        },
        'sede_id'   => function ()
        {
            return factory(Sede::class)->random()->id;
        },
        'facultad_id'   => function ()
        {
            return factory(Facultad::class)->random()->id;
        },
        'type_id'   => function ()
        {
            return factory(Type::class)->random()->id;
        },
    ];
});

$factory->define(Type::class, function (Faker\Generator $faker)
{
    return [
       'name' => 't'.$faker->unique()->word
    ];
});
/**
$factory->define(App\Menu::class, function (Faker\Generator $faker)
{
    return [
       'name'   => 'm'.$faker->unique()->word,
       'level'  => $faker->randomDigitNotNull,
       'order'  => $faker->randomDigitNotNull,
       'route'  => $faker->word,
       'parameter' => $faker->word,
    ];
});
*/

$factory->define(MenuType::class, function (Faker\Generator $faker)
{
    return [
        'type_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11]),
        'menu_id' => $faker->randomElement([1,2,3,4,5]),
    ];
});



