<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Courses\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'level' => collect([1, 2, 3, 4])->random(1)[0],
        'group' => collect(['a', 'b'])->random(1)[0],
    ];
});
