<?php

namespace App;
use App\Traits\ImageWizzard;
use Illuminate\Database\Eloquent\Model;

class SecondAd extends Model
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


          if (!$ad->save()) {
              return false;
          }

          //snimam sliku i dodjeljujem je reklami, prvo jednu pa drugu
          if($request->hasfile('sideImage')){
            $sideImage = self::storeImage($request, 'sideImage', $ad);
            if ($sideImage) {
                $ad->sideImage =  $sideImage;
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

           $ad->sideImage = $request->sideImage;
           $ad->downImage = $request->downImage;

           return $ad->save();
        }

        public static function destroyIt($secondAd){
          //moram pjeske jer imam slike u folderu...
          foreach ($secondAd->images as $image) {
             self::deleteImage($image->name);
             Image::destroy($image->id);
          }
          return self::destroy($secondAd->id);

        }
}
