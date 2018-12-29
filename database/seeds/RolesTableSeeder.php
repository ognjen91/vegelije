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
      $roleModerator->description = 'Moze da pise clanke, blogove, evente i edituje pojedine stranice';
      $roleModerator->save();
    }
}
