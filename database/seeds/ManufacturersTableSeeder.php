<?php

use Illuminate\Database\Seeder;
use App\Manufacturer;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m1 = new Manufacturer;
        $m1->name = "Štark";
        $m1->save();

        $m2 = new Manufacturer;
        $m2->name = "Jaffa Crvenka";
        $m2->save();

        $m3 = new Manufacturer;
        $m3->name = "Swisslion Takovo";
        $m3->save();

        $m4 = new Manufacturer;
        $m4->name = "Alpro";
        $m4->save();
    }
}
