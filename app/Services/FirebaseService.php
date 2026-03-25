<?php

namespace App\Services;

use Google\Client;
use Illuminate\Support\Facades\Http;

class FirebaseService
{
    private static function getAccessToken()
    {
        $client = new Client();
        $client->setAuthConfig(public_path('fcm.json'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->fetchAccessTokenWithAssertion();
        return $client->getAccessToken()['access_token'];
    }

    public static function sendNotification($deviceToken, $title, $body)
    {
        $url = "https://fcm.googleapis.com/v1/projects/mamlaka-98f9e/messages:send";
        $accessToken = self::getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type'  => 'application/json',
        ])->post($url, [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body'  => $body,
                ],
                'data' => [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ],
            ],
        ]);

        return $response->json();
    }
}
