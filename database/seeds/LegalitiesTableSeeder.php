<?php

use Illuminate\Database\Seeder;
use App\Legality;

class LegalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $leg1 = Legality::create([
        'name' => 'vegan'
      ]);

      $leg2 = Legality::create([
        'name' => 'vegetarian'
      ]);

      $leg3 = Legality::create([
        'name' => 'illegal'
      ]);

    }
}
