<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AlternativeName extends Model
{

  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];


  public function nameable()
   {
       return $this->morphTo();
   }

}
