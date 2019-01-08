<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Product;
use Illuminate\Http\Request;

class SuggestionAccepted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $suggestionId;
    public $isExactProduct;
    public $product;
    public $imagesAcceptedNames;
    public $imagesRejectedNames;
    public $declarationImage;
    public $decalrationImageAccepted;
    public $profileImage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product, Request $request)
    {
        $this->suggestionId = request('suggestionId');
        $this->product = $product;
        $this->isExactProduct = request('productOrProductGroup') == 'product';
        $this->imagesAcceptedNames = request('imagesAcceptedNames');
        $this->imagesRejectedNames = request('imagesRejectedNames');
        $this->profileImage = request('profileImage');

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
