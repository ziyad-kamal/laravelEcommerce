<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Comments;
use Faker\Generator as Faker;

$factory->define(Comments::class, function (Faker $faker) {
    return [ 
        'comment' => $faker->name,
        'item_id' => 30,
        'user_id' => 4,
    ];
});
