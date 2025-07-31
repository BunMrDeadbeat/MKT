<?php

namespace App\Http\Controllers;

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
}
