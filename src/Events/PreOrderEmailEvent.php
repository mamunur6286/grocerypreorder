<?php

namespace GroceryStore\PreOrderManagement\Events;

use GroceryStore\PreOrderManagement\Models\PreOrder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PreOrderEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $preOrder;

    /**
     * Create a new event instance.
     */
    public function __construct(PreOrder $preOrder)
    {
        $this->preOrder = $preOrder;

    }
}
