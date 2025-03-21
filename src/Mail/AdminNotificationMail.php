<?php

namespace GroceryStore\PreOrderManagement\Mail;

use GroceryStore\PreOrderManagement\Models\PreOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $preOrder;

    /**
     * Create a new message instance.
     */
    public function __construct(PreOrder $preOrder)
    {
        $this->preOrder = $preOrder;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'An Pre-oder submitted from Grocery Store',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pre-order-management::mail.admin_mail',
            with: ['preOrder' => $this->preOrder]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
