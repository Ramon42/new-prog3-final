<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'id_user' => factory('App\User')->create()->id,
        'conteudo' => $faker->text(),
    ];
});
