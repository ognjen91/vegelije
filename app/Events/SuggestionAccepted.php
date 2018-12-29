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
    public $image;
    public $declarationImage;
    public $imageAccepted;
    public $decalrationImageAccepted;

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
        $this->image = request('imageAcceptedName');
        $this->isImageAccepted = request('imageAccepted');
        if($this->isExactProduct){
          $this->declarationImage = request('declarationImageAcceptedName');
          $this->isDeclarationImageAccepted = request('declarationImageAccepted');
        }
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
