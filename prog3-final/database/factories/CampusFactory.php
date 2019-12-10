<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Campus::class, function (Faker $faker) {
    return [
        'campus' => $faker->sentence(1),
    ];
});
