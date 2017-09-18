<?php

use App\Eloquent\Admin\Issue\IssueType;
use Faker\Generator as Faker;

$factory->define(IssueType::class, function (Faker $faker) {
    return [
        'name'        => $faker->text(20),
        'type'        => $faker->randomElement(['Standard', 'Sub Task']),
        'description' => $faker->bs,
        'icon'        => $faker->file(resource_path('assets/images/icons/issuetypes')),
    ];
});
