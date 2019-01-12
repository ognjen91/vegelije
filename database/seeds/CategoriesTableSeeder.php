<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cat1 = Category::create([
        'name' => 'Slatko'
      ]);

      $cat2 = Category::create([
        'name' => 'Slano'
      ]);

      $cat3 = Category::create([
        'name' => 'Pića'
      ]);

      $cat4 = Category::create([
        'name' => 'Kozmetika'
      ]);

      $cat5 = Category::create([
        'name' => 'Hemija'
      ]);

      $cat6 = Category::create([
        'name' => 'Ostalo'
      ]);


    }
}
