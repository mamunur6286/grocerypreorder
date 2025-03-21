<?php

namespace GroceryStore\PreOrderManagement\Jobs;

use GroceryStore\PreOrderManagement\Mail\AdminNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use GroceryStore\PreOrderManagement\Models\PreOrder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class SendAdminEmailNotificationJob implements ShouldQueue
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
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info(Config::get('preorder.admin_email'));
        Mail::to(Config::get('preorder.admin_email'))->send(new AdminNotificationMail($this->preOrder));
    }
}
