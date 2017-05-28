<?php

use App\Acceso;
use App\Curso;
use App\DCurso;
use App\DataUser;
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

/**
$factory->define(Acceso::class, function (Faker\Generator $faker, $attributes) {
    return [
        'user_id'   => function ()
        {
            return User::all()->random()->id;
        },
        'sede_id'   => function ()
        {
            return Sede::all()->random()->id;
        },
        'facultad_id'   => function ()
        {
            return Facultad::all()->random()->id;
        },
        'type_id'   => function ()
        {
            return Type::all()->random()->id;
        },
    ];
});
*/


$factory->define(Facultad::class, function (Faker\Generator $faker)
{
    return [
        'cFacultad' => $faker->unique()->word, 
        'wFacultad'=> $faker->unique()->word
    ];
});

$factory->define(Sede::class, function (Faker\Generator $faker)
{
    return [
        'cSede' => $faker->unique()->word, 
        'wSede'=> $faker->unique()->word
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
$factory->define(DCurso::class, function (Faker\Generator $faker)
{
    return [
        'curso_id'  => Curso::random()->id,
        'user_id'   => User::random()->id,
    ];
});

$factory->define(MenuType::class, function (Faker\Generator $faker)
{
    return [
        'type_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11]),
        'menu_id' => $faker->randomElement([1,2,3,4,5]),
    ];
});

$factory->define(DataUser::class, function (Faker\Generator $faker) {
    //$user = User::find(factory(User::class)->random()->id);
    $wdoc1 = $faker->firstname;
    $wdoc2 = $faker->lastname;
    $wdoc3 = $faker->lastname;
    return [
        //'user_id' => $user->id,
        'wdoc1' => $wdoc1,
        'wdoc2' => $wdoc2,
        'wdoc3' => $wdoc3,    
        //'cdocente' => str_pad($this->user_id, 6, '0', STR_PAD_RIGHT),
        'fono1' => $faker->randomNumber($nbDigits = 9, $strict = false),
        'fono2' => $faker->randomNumber($nbDigits = 9, $strict = false),
        'email1' => $faker->email,
        'email2' => $faker->email,
        'whatsapp' => $faker->randomElement([true,false])
    ];
});

