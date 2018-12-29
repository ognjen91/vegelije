<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
      'name' => $faker->randomElement(['napolitanke', 'jadro kocke',
      'ledene kocke', 'cokolada', 'cokolada sa jagodom', 'cokolada sa lesnicima', 'noisette',
      'pivo', 'vino', 'keks', 'integrino', 'grisini', 'stapici', 'smoki', 'ribice',
      'perece', 'flips', 'chipsy', 'cips', 'milka cokolada jagoda', 'milka sa lesnicima',
      'bakla sa orasima', 'pita sa sirom', 'pita sa plazmom', 'pita sa pečurkama', 'sok od zove',
       'pepermint bombone', 'negro bombone', 'karamele', 'plazma', 'slana plama',
       'piškote', "integrino čokolada", "integrino limun", "najlepše želje jagoda", "najlepše želje lešnik",
       "galeb čokolada", "carska mešavina", "mediteranska mešavina", "balkanska mešavina", "ruska salata mešavina",
       "knedle sa šljivama", "ledene kocke", "sok od jagode", "sok jagoda", "jagoda", "sok breska", "sok od breskve",
       "hrana za pse", "hrana za mačke", "hrana psi", "hrana mačke", "mentol bombone", "tost namaz",
      "tost hleb", "biljni sir", "mammas pizza", "mammas toast", "tostino", "margarin", "posni margarin",
      "majonez", "posni majonez", "don kafa", "doncaffe", "nes kafa", "nescaffe", "jelen pivo", "lav pivo",
      "tuborg pivo", "nikšićko pivo", "nikšićko tamno", "nikšićko svetlo", "nikšićko svijetlo", "nikšićko",
       "haineken", "vino", "stono vino", "tamno vino", "crno vino", "belo vino", "rakija šljiva", "rakija dud",
       "rakija kajsija", "rakija dunja", "podloga za pizzu", "kore za pitu", "pašteta", "pašteta od soje",
      "pašteta od suncokreta", "namaz od soje", "namaz od suncokreta", "humus", "žuti sok", "crni sok",
      "žele zeka", "žele", "bajadera", "bajadere", "praline", "praline jagoda", "praline od jagode", "mars čokolada", "mars",
      "snickers čokolada", "snickers", "snickers čokoladica", "twix čokolada", "twix čokoladica", "twix", "bounty",
     "bounty čokolada", "bounty čokoladica"]),
      'description'=>  $faker->text(30),
      'category_id' => App\Category::all()->random()->id,
      'manufacturer_id' => App\Manufacturer::all()->random()->id,
      'user_id' => App\User::all()->random()->id
    ];
});
