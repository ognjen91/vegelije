<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $guarded = ['id'];

    public static function productsViews(){
      $productsCounter =  self::firstOrCreate(['count' => 'products']);
      return $productsCounter->value;
    }

    public static function productGroupsViews(){
      $groupsCounter = self::firstOrCreate(['count' => 'productGroups']);
      return $groupsCounter->value;
    }


    public static function incrementProductsViews(){
      $counter = self::firstOrCreate(['count' => 'products']);
      $counter->value += 1;
      $counter->save();
    }

    public static function incrementProductGroupsViews(){
      $counter = self::firstOrCreate(['count' => 'productGroups']);
      $counter->value += 1;
      $counter->save();
    }
}
