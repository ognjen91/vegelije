<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageWizzard;


class MainAd extends Model
{

    use ImageWizzard;
      protected $guarded = ['id'];

      public function images()
      {
          return $this->morphMany(Image::class, 'imageable');
      }


      public static function store($request){

        $ad = new self;
        $ad->name =  $request->name;
        $ad->link = $request->link;
        $ad->intervalInSeconds = $request->intervalInSeconds;

        if (!$ad->save()) {
            return false;
        }

        //snimam sliku i dodjeljujem je reklami, prvo jednu pa drugu
        if($request->hasfile('popupImage')){
          $popupImage = self::storeImage($request, 'popupImage', $ad);
          if ($popupImage) {
              $ad->popupImage =  $popupImage;
          }
        }

        if($request->hasfile('downImage')){
        $downImage = self::storeImage($request, 'downImage', $ad);
        if ($downImage) {
            $ad->downImage =  $downImage;
        }

          return $ad->save();
        }
      }



      public static function updateAd($ad, $request){
         $ad->name =  $request->name;
         $ad->link = $request->link;
         $ad->intervalInSeconds = $request->intervalInSeconds;
         $ad->popupImage = $request->popupImage;
         $ad->downImage = $request->downImage;

         return $ad->save();
      }


      public static function destroyIt($mainAd){
        //moram pjeske jer imam slike u folderu...
        foreach ($mainAd->images as $image) {
           self::deleteImage($image->name);
           Image::destroy($image->id);
        }
        return self::destroy($mainAd->id);

      }

      public static function getActives(){
        // dd(self::where('active', '1')->inRandomOrder()->get());
        return self::where('active', '1')->inRandomOrder()->get();
      }
}
