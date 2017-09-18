<?php

use App\Eloquent\ProjectCategories;
use Faker\Generator as Faker;

$factory->define(ProjectCategories::class, function (Faker $faker) {
    return [
        'name'         => snake_case($faker->word),
        'description'  => $faker->bs,
    ];
});
