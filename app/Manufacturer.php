<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Manufacturer extends Model
{
  use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function products(){
      return $this->hasMany(Product::class);
    }
}
