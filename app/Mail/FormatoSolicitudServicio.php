<?php

namespace App\Mail;

use App\Models\Orden;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormatoSolicitudServicio extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $fieldLabels;
    /**
     * Create a new message instance.
     */
    public function __construct(Orden $order) 
    {
        $this->order = $order;
        $this->fieldLabels = [
            'company_name'    => 'Nombre de la empresa',
            'company_field'   => 'Giro de la empresa',
            'company_role'    => 'Puesto en la Empresa',
            'company_size'    => 'Tamaño de la Empresa',
            'website'         => 'Sitio Web Actual y/o Red Social Principal',
            'project_details' => 'Principal desafío o proyecto',
            'budget'          => 'Presupuesto Estimado',
            'urgency'         => 'Nivel de Urgencia',
        ]; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Su Confirmación de solicitud de servicio DuranMKT con folio: ' . $this->order->folio, 
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.formato-solicitud-servicio',
            with: [
                'order' => $this->order,
                'fieldLabels' => $this->fieldLabels,
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
