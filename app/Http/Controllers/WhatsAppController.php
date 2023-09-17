<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            $to = $request->input('to');
            $message = $request->input('message');
            $twilio = new Client(config('services.twilio.account_sid'), config('services.twilio.auth_token'));

            $twilio->messages->create(
                "whatsapp:$to",
                [
                    "from" => "whatsapp:" . config('services.twilio.whatsapp_from'),
                    "body" => $message,
                ]
            );

            return response()->json(['message' => 'Message sent successfully'], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()],422);
        }
    }

}
