<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Combinacao::class, function (Faker $faker) {
    return [
        'id_user1' => factory('App\User')->create()->id,
        'id_user2' => factory('App\User')->create()->id,
    ];
});
