<?php

namespace App\Mail;

use App\Models\Orden; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\View\Components\OrderConfirmationClientMailLayout;

class FormatoOrden extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Orden
     */
    public $order; // Declare a public property to hold the order

    /**
     * Create a new message instance.
     */
    public function __construct(Orden $order) // Inject the Order model
    {
        $this->order = $order; // Assign the injected order to the public property
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Su Confirmación de orden con folio: ' . $this->order->folio, 
        );
    }


    public function layout(): string
    {
        return 'order-confirmation-client-mail-layout.blade';
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.formato-orden', // Blade view for the email content
            with: [
                'order' => $this->order, // Pass the order object to the view
            ],
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