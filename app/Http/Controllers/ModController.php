<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModController extends Controller
{

  public function create(){
    $users = \App\User::all();
    return view('admin.business.mods', compact('users'));
  }

  public function store(Request $request){
    $user = new \App\User;
    $user->name = request('name');
    $user->email = request('email');
    $user->password = bcrypt(request('password'));

    $user->save();
    $user->roles()->sync([2]);

    return redirect()->back()->withSuccess('Novi moderator je uspješno kreiran');

  }



    public function edit(){
      $usersProducts = \Auth::user()->products()->orderBy('name', 'asc')->with('manufacturer', 'category')->get();
      $usersProductGroups = \Auth::user()->productGroups()->orderBy('name', 'asc')->with('category')->get();
      return view('admin.business.profile', compact('usersProducts', 'usersProductGroups'));
    }

    public function update(Request $request, $id){
      if((int)$id !== \Auth::user()->id) return redirect()->back()->withError('Ne možete mijenjati tuđe podatke.');
      $user = \Auth::user();
      $user->email = request('email');
      if(request('newPassword')) $user->password = bcrypt($request->newPassword);
      $user->save();
      return redirect()->back()->withSuccess('Podaci uspjеšno promjenjeni');
    }
}
