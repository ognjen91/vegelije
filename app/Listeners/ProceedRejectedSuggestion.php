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
        \DB::table('notifications')->where('type', 'App\Notifications\NewSuggestionCreated')
                                    ->where('data', 'LIKE', '%"id":'.$event->suggestionId.'%')
                                    ->whereNull('read_at')                                 // ->get();
                                    ->update(
                                      ['read_at' => date("Y-m-d H:i:s")]
                                    );

    }
}
