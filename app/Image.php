<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{

  protected $guarded = ['id'];


  public function imageable()
 {
     return $this->morphTo();
 }
}
