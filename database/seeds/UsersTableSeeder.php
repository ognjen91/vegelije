<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = new User;
      $admin->name = 'Ognjen';
      $admin->email = "qzman16@gmail.com";
      $admin->password = bcrypt('123456');
      $admin->save();

      $role1 = App\Role::where('name', 'Admin')->first();
      $admin->roles()->attach($role1);

      $moderator = new User;
      $moderator->name = 'Mod';
      $moderator->email = "moderator@gmail.com";
      $moderator->password = bcrypt('123456');
      $moderator->save();

      $role2 = App\Role::where('name', 'Moderator')->first();
      $moderator->roles()->attach($role2);
    }
}
