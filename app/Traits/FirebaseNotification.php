<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\DeviceToken;
use App\Models\Notification;

trait FirebaseNotification
{

    public function sendFcm($data,)
    {
        $apiUrl = 'https://fcm.googleapis.com/v1/projects/malakia-cd959/messages:send';
        $accessToken = $this->getAccessToken();

         
            $adminIds=Admin::where('status',1)->pluck('id');
            $deviceTokens = DeviceToken::whereIn('admin_id',$adminIds)->pluck('token')->toArray();
            foreach ($adminIds as $adminId) {
                Notification::create([
                    'title' => $data['title'],
                    'body' => $data['body'],


                ]);
            }
    



        $responses = [];
        foreach ($deviceTokens as $token) {
            $payload = $this->preparePayload($data, $token);
            $responses[] = $this->sendNotification($apiUrl, $accessToken, $payload);
        }

        return response()->json(['responses' => $responses]);
    }

    // edit
    protected function getAccessToken()
    {
        $credentialsFilePath = storage_path('app/firebase/malakia.json');
        $client = new \Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();

        return $client->getAccessToken()['access_token'];
    }

    protected function preparePayload($data, $token)
    {

        $message = [
            'notification' => [
                'title' => $data['title'],
                'body' => $data['body'],

            ],

            'token' => $token
        ];

        return json_encode(['message' => $message]);
    }

    protected function sendNotification($url, $accessToken, $payload)
    {
        $headers = [
            "Authorization: Bearer " . $accessToken,
            'Content-Type: application/json'
        ];



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return ['error' => $error_msg];
        }

        $info = curl_getinfo($ch);
        curl_close($ch);

        return ['response' => json_decode($response, true), 'info' => $info];
    }
}
