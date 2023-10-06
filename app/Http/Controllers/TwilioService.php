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
        return $this->client->messages->create(
            'whatsapp:'.$to,
            [
                "from" => config('services.twilio.whatsapp_from'),
                "body" => $message,
            ]
        );
    }
}
