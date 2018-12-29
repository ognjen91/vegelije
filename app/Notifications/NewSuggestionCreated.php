<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class NewSuggestionCreated extends Notification
{
    use Queueable;
    protected $notificationId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($suggestionId, $suggestionName)
    {
        $this->suggestionId = $suggestionId;
        $this->suggestionName = $suggestionName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'what' => 'sugestija', //ovo je za neki brzi prikaz, naravno da ce imati i svoj poseban template
            'id' => $this->suggestionId,
            'name' => $this->suggestionName,
            'date' => Carbon::now()->toDateString()
        ];
    }
}
