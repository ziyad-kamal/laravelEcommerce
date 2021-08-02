<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Items;
use Faker\Generator as Faker;

$factory->define(Items::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->word(),
        'condition'   => $faker->word(),
        'price'       => $faker->numberBetween(1000,5000),
        'category_id' => 1,
        'brand_id'    => 1,
        'photo'       => $faker->word(),
        'users_id'    => 4,
        'slug'        => $faker->unique()->word(),
        'date'        => now(),
    ];
});
