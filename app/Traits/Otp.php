<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

trait Otp
{

    public function pushOtp($receiverNumber, $message)
    {
        try {
            $accountSid = env('TWILIO_SID');
            $authToken = env('TWILIO_TOKEN');
            $twilioNumber = env('TWILIO_FROM');

            $client = new Client($accountSid, $authToken);

            $client->messages->create($receiverNumber, [
                'from' => $twilioNumber,
                'body' => $message,
            ]);

            return [
                'success' => true,
                'message' => 'SMS sent successfully.',
            ];
        } catch (Exception $e) {
            Log::error('Twilio SMS Error: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Failed to send SMS. ' . $e->getMessage(),
            ];
        }
    }
}
