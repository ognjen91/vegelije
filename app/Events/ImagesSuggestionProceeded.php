<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ImagesSuggestionProceeded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $suggestion;
    public $imagesAcceptedNames;
    public $imagesRejectedNames;
    public $profileImage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($suggestion, $imagesAcceptedNames, $imagesRejectedNames, $profileImage)
    {
        $this->suggestion = $suggestion;
        $this->imagesAcceptedNames = $imagesAcceptedNames;
        $this->imagesRejectedNames = $imagesRejectedNames;
        $this->profileImage = $profileImage;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
