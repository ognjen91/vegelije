<?php

namespace App\Listeners;

use App\Events\SuggestionRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\Suggestion;
use App\User;

class ProceedRejectedSuggestion
{
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
     * @param  SuggestionRejected  $event
     * @return void
     */
    public function handle(SuggestionRejected $event)
    {
        // treba soft delete Suggestion-a i da se skloni notifikacija...
        Suggestion::find($event->suggestionId)->delete();

        //skidanje iz notifikacija ostalih usera
        foreach (User::all() as $user) {
          if($user->hasAnyRole(['Admin', 'Moderator'])){
           foreach ($user->notifications as $notification) {
             if($notification->type == 'App\Notifications\NewSuggestionCreated'){
                 if($notification->data['id'] == $event->suggestionId) $notification->markAsRead();
             }
           }
         }
        }
    }
}
