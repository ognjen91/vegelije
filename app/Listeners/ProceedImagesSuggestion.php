<?php

namespace App\Listeners;

use App\Events\ImagesSuggestionProceeded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Traits\ImageWizzard;
use App\Image;
use App\ImageSuggestion;
use App\Notifications\ImageSuggestionCreated;


class ProceedImagesSuggestion
{

  use ImageWizzard;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {


    }

    /**
     * Handle the event.
     *
     * @param  ImagesSuggestionProceeded  $event
     * @return void
     */
    public function handle(ImagesSuggestionProceeded $event)
    {
            // 1...za prihvacene slike promjeniti podatke u tabeli images
      if($event->imagesAcceptedNames){
        foreach ($event->imagesAcceptedNames as $imageName) {
          $image = Image::where('name', $imageName)->first();
          $image->imageable_type = get_class($event->suggestion->product);
          $image->imageable_id = $event->suggestion->product->id;
          $image->save();
        }
      }
      // 2... obrisati neprihvacene slike
      if($event->imagesRejectedNames){
        foreach ($event->imagesRejectedNames as $imageName) {
          $image = Image::where('name', $imageName)->first();
          Image::destroy($image->id);
          self::deleteImage($imageName);
        }
      }
      // 3... ako je neka prihvacena za profilnu, i to postaviti
       if($event->profileImage){
         $event->suggestion->product->image = $event->profileImage;
         $event->suggestion->product->save();
       }
       // 4.izbrisati zahtjev i notifikacije vezane za njega
       ImageSuggestion::destroy($event->suggestion->id);
       \DB::table('notifications')->where('type', ImageSuggestionCreated::class)
                                  ->where('data', 'LIKE', '%"id":'.$event->suggestion->id.'%')                               // ->get();
                                   ->delete();
    }
}
