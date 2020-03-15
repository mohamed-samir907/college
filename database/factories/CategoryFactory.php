<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Courses\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'course_id' => collect([1, 2, 3, 4])->random(1)[0]
    ];
});
