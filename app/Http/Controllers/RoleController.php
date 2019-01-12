<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class RoleController extends Controller
{
    public function edit($id){
      $user = User::find($id);
      if(!$user) return redirect()->route('home')->withError('Menjanje nepostojećeg korisnika');

      $user->hasAnyRole('Moderator') ? $user->roles()->sync([3]) : $user->roles()->sync([2]);
      return redirect()->back()->withSuccess('Uloga korisnika uspješno promjenjena');
    }
}
