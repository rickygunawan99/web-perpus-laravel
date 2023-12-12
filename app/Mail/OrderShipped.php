<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(
    )
    {
        //
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Shipped',
        );
    }
    public function content()
    {
        return new Content(
            view: 'mail.order-ship',
        );
    }
    public function attachments()
    {
        return [];
    }
}
