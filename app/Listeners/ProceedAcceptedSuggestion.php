<?php

namespace App\Listeners;

use App\Events\SuggestionAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Suggestion;
use App\Traits\ImageWizzard;
use App\User;
use App\Image;

class ProceedAcceptedSuggestion
{

  use ImageWizzard;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SuggestionAccepted  $event
     * @return void
     */
    public function handle(SuggestionAccepted $event)
    {

        //prvo treba hard delete Suggestion-a, pa premjestiti lokaciju slike
        // $isDestroyed = Suggestion::forceDelete($event->suggestionId);
        $isDestroyed = Suggestion::withTrashed()->find($event->suggestionId)->forceDelete();
        if(!$isDestroyed) return redirect()->route('home')->withError('Greška pri obradi sugestije. Molimo, obavjestite administratora. Error : greška pri obradi');
        $event->product->fromSuggestion = $event->suggestionId;

      //za prihvacene slike elegantno mijenjam podatke, tako da sada pripadaju proizvodu ili grupi proizvoda
        if($event->imagesAcceptedNames){
          foreach ($event->imagesAcceptedNames as $imageName) {
            $image = Image::where('name', $imageName)->first();
            $image->imageable_type = get_class($event->product);
            $image->imageable_id = $event->product->id;
            $image->save();
          }
        }

          //mijenjam profilnu, ako je setovana
           if($event->profileImage) $event->product->image = $event->profileImage;

           // brisem slike koje nisu prihvacene
        if($event->imagesRejectedNames){
           foreach ($event->imagesRejectedNames as $imageName) {
             $image = Image::where('name', $imageName)->first();
             if(Image::destroy($image->id)) self::deleteImage($imageName);
           }
         }

           $event->product->save();

           //skidanje iz notifikacija ostalih usera
           \DB::table('notifications')->where('type', 'App\Notifications\NewSuggestionCreated')
                                      ->where('data', 'LIKE', '%"id":'.$event->suggestionId.'%')
                                      ->delete();


    }
}
