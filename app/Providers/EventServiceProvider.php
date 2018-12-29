<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\SuggestionAccepted'=>[
          'App\Listeners\ProceedAcceptedSuggestion', //treba je izbrisati [destroy], a slike premjestiti + izbrisati notif
        ],
        'App\Events\SuggestionRejected'=>[
          'App\Listeners\ProceedRejectedSuggestion', //treba je izbrisati [soft delete] + izbrisati notif
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
