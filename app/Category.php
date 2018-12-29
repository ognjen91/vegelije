<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $guarded = ['id'];

   public function getRouteKeyName(){
   return 'name';
   }

   public function products(){
     return $this->hasMany(Product::class);
   }

   public function productGroups()
   {
       return $this->hasMany(ProductGroup::class);
   }

   public function tags(){
      return $this->hasManyThrough(Product::class, Tag::class);
   }
}
