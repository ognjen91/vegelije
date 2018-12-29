<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $guarded = ['id'];

  public function users(){
    return $this->belongsToMany(User::class); //preko user_role pivot-a
  }


}
