<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageWizzard;


class Manufacturer extends Model
{
  use SoftDeletes;
  use ImageWizzard;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function products(){
      return $this->hasMany(Product::class);
    }

    public function images()
     {
         return $this->morphMany(Image::class, 'imageable');
     }



     public static function store($request){
        $manufacturer = new self;
        $manufacturer->name = request('name');
        $manufacturer->description = request('description');

        if (!$manufacturer->save()) {
            return false;
        }

        //snimam sliku i dodjeljujem je za profilnu modelu
        $image = self::storeImage($request, 'image', $manufacturer);
        if ($image) {
            $manufacturer->image =  $image;
            $manufacturer->save();
        }
        return $manufacturer;
      }



        public static function updateManufacturer($manufacturer, $request)
        {
          $manufacturer->name = request('name');
          $manufacturer->description = request('description');
          $manufacturer->image = request('image');

          if ($manufacturer->save()) return $manufacturer;

          return redirect()->back()->withError('Greška pri ažuriranju proizvođača');
        }

}
