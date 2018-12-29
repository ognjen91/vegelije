<?php

use Faker\Generator as Faker;

$factory->define(App\AlternativeName::class, function (Faker $faker) {
    return [
      'name' => $faker->words(3, true),
      'nameable_type' => $faker->randomElement([App\Product::class, App\ProductGroup::class]),
      'nameable_id' => $faker->randomElement([ App\Product::all()->random()->id, App\ProductGroup::all()->random()->id ])
    ];
});
