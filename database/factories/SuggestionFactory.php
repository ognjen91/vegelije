<?php

use Faker\Generator as Faker;

$factory->define(App\Suggestion::class, function (Faker $faker) {
    return [
       'name' => $faker->words(2,true),
       'manufacturer' => $faker->word,
       'legality'=> $faker->numberBetween(1,3),
       'tags'=> $faker->word .','.$faker->word.','.$faker->word
    ];
});
