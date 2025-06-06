<?php

namespace App\Mail;

use App\Models\Order; // Assuming you have an Order model
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment; // Import Attachment
use Illuminate\Queue\SerializesModels;

class FormatoOrden extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order; // Declare a public property to hold the order

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order) // Inject the Order model
    {
        $this->order = $order; // Assign the injected order to the public property
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Confirmation: #' . $this->order->order_number, // Dynamic subject
            // You can also set 'from' and 'to' here if they are static for this mailer
            // from: new Address('noreply@yourcompany.com', 'Your Company Name'),
            // to: $this->order->customer_email, // Assuming customer_email on order
        );
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
        return [
            // Example of attaching a PDF, assuming you have a path to it
            // 'path/to/your/order/pdfs/order_' . $this->order->id . '.pdf',
            Attachment::fromPath(public_path('invoices/order_' . $this->order->order_number . '.pdf'))
                      ->as('Order_' . $this->order->order_number . '.pdf')
                      ->withMime('application/pdf'),
        ];
    }
}