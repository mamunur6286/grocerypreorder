<?php

namespace GroceryStore\PreOrderManagement\Listeners;

use GroceryStore\PreOrderManagement\Events\PreOrderEmailEvent;
use GroceryStore\PreOrderManagement\Jobs\SendAdminEmailNotificationJob;
use GroceryStore\PreOrderManagement\Jobs\SendUserEmailNotificationJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class SendPreOrderEmailConfirmation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PreOrderEmailEvent $event): void
    {
        $preOrder = $event->preOrder;

        Bus::chain([
            new SendAdminEmailNotificationJob($preOrder), 
            new SendUserEmailNotificationJob($preOrder)
        ])->dispatch();
    }
}
