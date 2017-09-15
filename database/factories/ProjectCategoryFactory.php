<?php

use Faker\Generator as Faker;
use App\Eloquent\ProjectCategories;

$factory->define(ProjectCategories::class, function (Faker $faker) {
    return [
        'name'         => snake_case($faker->word),
        'description'  => $faker->bs,
    ];
});
