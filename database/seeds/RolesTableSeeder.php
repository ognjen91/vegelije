<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roleAdmin = new Role;
      $roleAdmin->name = "Admin";
      $roleAdmin->description = 'Tata-Mata kucnih aparata, može sve i može svugdje';
      $roleAdmin->save();

      $roleModerator = new Role;
      $roleModerator->name = "Moderator";
      $roleModerator->description = 'Moze da dodajte nove proizvode/grupe i da vrši reviziju';
      $roleModerator->save();

      $role3 = new Role;
      $role3->name = "Razvlašćen";
      $role3->description = 'Oduzeta moderatorska prava';
      $role3->save();
    }
}
