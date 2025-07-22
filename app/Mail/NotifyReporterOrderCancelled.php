<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class NotifyReporterOrderCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Work Order Cancelled',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reporter-cancelled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
