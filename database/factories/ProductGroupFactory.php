<?php

use Faker\Generator as Faker;

$factory->define(App\ProductGroup::class, function (Faker $faker) {
    return [
      'name' => $faker->randomElement(['cokolada', 'napolitanke', 'carska mesavina', 'bombone', 'E222',
                                      'piskote', 'sir', 'mleko', 'crni sok', 'zuti sok', 'pasteta od soje',
                                      'pasteta od suncokreta']),
      'description'=>  $faker->text(30),
      'category_id' => App\Category::all()->random()->id,
      'user_id' => App\User::all()->random()->id,


    ];
});
