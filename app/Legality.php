<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
   protected $guarded = ['id'];

  public function products()
  {
      return $this->morphedByMany('App\Product', 'legalable');
  }

  // public function productGroups()
  // {
  //     return $this->morphedByMany('App\ProductGroup', 'legalable');
  // }

  /**
   * [syncLegality description]
   * @param  integer $number [1-vegan, 2-vegetarian, 3-illegal]
   * @param  Model   $model  [description]
   * @return [type]          [description]
   */

  public static function syncLegality($number, Model $model){
    if ($number == 1){
      $legals = [1,2]; //ako je vegansko, po def je i vegetarijansko
    } else {
      $legals = [$number];
    }

    if ($model->legalities()->sync($legals)) return true;
  }
}
