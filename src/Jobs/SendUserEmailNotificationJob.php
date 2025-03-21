<?php

namespace GroceryStore\PreOrderManagement\Jobs;

use GroceryStore\PreOrderManagement\Mail\UserConfirmationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use GroceryStore\PreOrderManagement\Models\PreOrder;

class SendUserEmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $preOrder;

    /**
     * Summary of __construct
     * @param \GroceryStore\PreOrderManagement\Models\PreOrder $preOrder
     */
    public function __construct(PreOrder $preOrder)
    {
        $this->preOrder = $preOrder;
    }

    /**
     * Summary of handle
     * @return void
     */
    public function handle()
    {
        Mail::to($this->preOrder->email)->send(new UserConfirmationMail($this->preOrder));
    }
}