<?php
// app/Services/TwilioService.php

namespace App\Http\Controllers;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.account_sid'),
            config('services.twilio.auth_token')
        );
    }

    public function sendSMS($to, $message)
    {
        try {
            $response = $this->client->messages->create(
                'whatsapp:' . $to,
                [
                    "from" => config('services.twilio.whatsapp_from'),
                    "body" => $message,
                ]
            );
            return $response->id;
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return null;
        }
    }

    public function sendWhatsappToFile($to, $message, $mediaUrl)
    {
        try {
            $response = $this->client->messages->create(
                'whatsapp:+918128273971',
                [
                    "from" => config('services.twilio.whatsapp_from'),
                    "body" => $message,
                    "mediaUrl" => $mediaUrl,
                ]
            );
            return $response;
        } catch (\Exception $exception) {
            return null;
        }
    }
}
