<?php

use App\Eloquent\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name'             => $faker->unique()->word,
        'description'      => $faker->bs,
        'key'              => strtoupper($faker->unique()->text($maxNbChars = 5)),
        'type'             => $faker->numberBetween(1, 3),
        'lead'             => $faker->numberBetween(1, 4),
        'default_assignee' => $faker->numberBetween(1, 4),
        'category'         => $faker->numberBetween(1, 10),
        'enabled'          => $faker->randomElement($array = ['Y', 'N']),
    ];
});
