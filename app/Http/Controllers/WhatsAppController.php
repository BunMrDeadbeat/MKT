<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
     public function handleIncomingMessage(Request $request)
    {
        $from = $request->input('From');
        $body = $request->input('Body');

        Log::info("Incoming message from {$from}: {$body}");

    
        $supportNumber = env('WHATSAPP_SUPPORT_NUMBER');
        $twilioWhatsAppFrom = env('TWILIO_WHATSAPP_FROM');

      
        $replyMessage = "¡Gracias por contactarnos! Para obtener soporte personalizado, por favor envíe su mensaje a nuestro número de atención al cliente en WhatsApp: {$supportNumber}. ¡Estamos para ayudarle!";

      
        try {
            $twilioSid = env('TWILIO_SID');
            $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
            $twilio = new Client($twilioSid, $twilioAuthToken);

            $twilio->messages->create(
                $from,
                [
                    'from' => "whatsapp:{$twilioWhatsAppFrom}",
                    'body' => $replyMessage
                ]
            );

            Log::info("Sent auto-reply to {$from}");

        } catch (\Exception $e) {
            Log::error("Failed to send auto-reply: " . $e->getMessage());
        }
        
        return response('OK', 200);
    }

    public function sendWhatsAppServiceNotification(string $recipientPhoneNumber, Orden $order)
{
    Log::info('--- Attempting to send WhatsApp message ---');
    Log::info('Recipient Phone Number: ' . $recipientPhoneNumber);

    $twilioSid = env('TWILIO_SID');
    $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
    $twilioWhatsAppFrom = env('TWILIO_WHATSAPP_FROM');

    if (!$twilioSid || !$twilioAuthToken || !$twilioWhatsAppFrom) {
        Log::error('Twilio credentials are not set in the .env file or cache.');
        return;
    }
    $servicio = $order->product->first();
    if (!$servicio) {
        Log::error("Order {$order->folio} has no products/services to notify about.");
        return;
    }

    $messageBody = "Estimado(a) *{$order->user->name}*,\n\n";
    $messageBody .= "Le confirmamos la recepción de su solicitud de servicio en *DuranMKT*.\n\n";
    $messageBody .= "Su número de folio para seguimiento es: *{$order->folio}*\n";
    $messageBody .= "____________________________________\n\n";

    // Detalles de la solicitud
    $messageBody .= "*DETALLES DE LA SOLICITUD*\n\n";
    $messageBody .= "*Servicio:* {$servicio->producto->name}\n\n";

    foreach ($servicio->opciones as $opcion) {
        $optionName = str_replace('_', ' ', $opcion->option_name);
        $messageBody .= "• *".ucwords($optionName).":* {$opcion->option_value}\n";
    }

    $messageBody .= "____________________________________\n\n";

    // Pasos a seguir e información de contacto
    $messageBody .= "Nuestro equipo ha comenzado a revisar su solicitud y nos pondremos en contacto con usted a la brevedad.\n\n";
    $messageBody .= "Si tiene alguna consulta o desea añadir información, por favor contacte a nuestro equipo de soporte. Tenga a la mano su folio de solicitud.\n\n";
    $messageBody .= "Atentamente,\n";
    $messageBody .= "*El equipo de DuranMKT*\n";
    $messageBody .= "Contacto:" . env('WHATSAPP_SUPPORT_NUMBER');


    try {
        $twilio = new Client($twilioSid, $twilioAuthToken);
        $message = $twilio->messages->create(
            "whatsapp:{$recipientPhoneNumber}",
            [
                "from" => "whatsapp:{$twilioWhatsAppFrom}",
                "body" => $messageBody,
            ]
        );
        Log::info('WhatsApp message sent successfully! SID: ' . $message->sid);
    } catch (\Exception $e) {
        Log::error('!!! WhatsApp notification failed !!!');
        Log::error('Twilio Error: ' . $e->getMessage());
    }
}
}
