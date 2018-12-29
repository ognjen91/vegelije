<?php

namespace App\Listeners;

use App\Events\SuggestionAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Suggestion;
use App\Traits\ImageWizzard;
use App\User;

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

//ovo treba razmotriti, kad odlucim gdje cu cuvati slike iz sugestija
        if($event->isImageAccepted){
          $event->product->image = $event->image;
        } else {
          //nista... necu ni brisati
          // if($event->image !== 'placeholder.png') self::deleteImage($event->image);
        }

     if($event->isExactProduct){
       if($event->isDeclarationImageAccepted){
         $event->product->declarationImage = $event->declarationImage;
       }else{
         //isto nista
         // if($event->declarationImage !== 'placeholder.png') self::deleteImage($event->declarationImage);
       }

       $event->product->save();

       //skidanje iz notifikacija ostalih usera
       foreach (User::all() as $user) {
         if($user->hasAnyRole(['Admin', 'Moderator'])){
          foreach ($user->notifications as $notification) {
            if($notification->type == 'App\Notifications\NewSuggestionCreated'){
                if($notification->data['id'] == $event->suggestionId) $notification->forceDelete();
            }
          }
        }
       }


     }


        //treba jos srediti notifikacije
    }
}
