<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Mensagem::class, function (Faker $faker) {
    return [
        'sent_by' => factory('App\User')->create()->id,
        'id_combinacao' => factory('App\Combinacao')->create()->id,
        'msg' => $faker->text(),
    ];
});
