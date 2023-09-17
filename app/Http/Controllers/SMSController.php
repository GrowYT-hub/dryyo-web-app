<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\InfobipService;

class SMSController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendSMS()
    {
        $to = '+918128273971'; // Recipient phone number
        $message = 'Hello, this is a test message.'; // Your SMS message

        $response = $this->twilioService->sendSMS($to, $message);

        return response()->json(['message' => 'SMS sent successfully', 'response' => $response]);
    }
}
