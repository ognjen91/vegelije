<?php

use Faker\Generator as Faker;

$factory->define(App\Manufacturer::class, function (Faker $faker) {
    return [
      'name' => $faker->randomElement(['Aplro', 'Jafa', 'Podravka', 'Pordavka', 'Takvo', 'Rosa',
      'Pekara Aleksandrija', 'Pekara Sušić', 'Pekara Mijatovic', 'Pekara Petrovic',
      'Coca Cola', 'Coca Cola Srbija', 'Foodland', 'Foodworld', 'Soulfood Serbia',
       'Soulfod Serbia', 'Soulfud Serbia', 'Delhaze', 'Dobro', 'Maxi', 'Idea',
       'Nestle', 'Nestl', 'Milka', 'Crvenka', 'Jafa Crvenka', 'Stark', 'Biodolina',
       'Zelena Dolina', 'DIS', 'Obuca Arilje', 'Jumko', 'BegeVege', 'Bege Vege',
       'Posno slasno', 'Hleb i kifle']),
    ];
});
