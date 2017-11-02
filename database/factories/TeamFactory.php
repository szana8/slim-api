<?php

use App\Eloquent\Admin\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    $title = $faker->unique()->jobTitle;

    return [
        'name'         => snake_case($title),
        'display_name' => $title,
        'description'  => $faker->bs,
    ];
});
