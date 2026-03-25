<?php

namespace App\Services\OneSignal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Exception;

class OneSignalService
{
    protected Client $client;
    protected mixed $appId;
    protected mixed $apiKey;
    protected mixed $apiUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->appId = env('ONESIGNAL_APP_ID');
        $this->apiKey = env('ONESIGNAL_API_KEY');
        $this->apiUrl = env('ONESIGNAL_API_URL');

        if (empty($this->appId) || empty($this->apiKey)) {
            Log::warning("ONESIGNAL_APP_ID and ONESIGNAL_API_KEY must be set in the .env file");
        }
    }

    /**
     * إرسال إشعار إلى مستخدم معين باستخدام Player ID
     */
    public function sendNotificationToUser($playerId, $title, $message, $url = null, $data = [])
    {
        try {
            $payload = [
                'json' => [
                    'app_id' => $this->appId,
                    'include_player_ids' => is_array($playerId) ? $playerId : [$playerId],
                    'headings' => ['en' => $title],
                    'contents' => ['en' => $message],
                    'url' => $url,
                    'data' => $data,
                ],
                'headers' => [
                    'Authorization' => $this->apiKey, // ✅ تأكد من استخدام 'Basic'
                    'Content-Type' => 'application/json'
                ]
            ];

            $response = $this->client->post($this->apiUrl, $payload);

            return json_decode($response->getBody()->getContents(), true);

        } catch (RequestException $e) {
            Log::error("OneSignal notification failed: " . $e->getMessage());
            if ($e->hasResponse()) {
                Log::error($e->getResponse()->getBody()->getContents());
            }
            return false;
        }
    }


    public function sendIncomingCallNotification($playerId, $callerName, $url = null, $data = [])
    {
        try {
            $payload = [
                'json' => [
                    'app_id' => $this->appId,
                    'include_player_ids' => is_array($playerId) ? $playerId : [$playerId],
                    'headings' => ['en' => 'مكالمة واردة'],
                    'contents' => ['en' => "لديك مكالمة واردة من {$callerName}"],
                    'url' => $url,
                    'data' => $data,
                    'buttons' => [
                        ['id' => 'accept_call', 'text' => 'رد', 'icon' => 'ic_call_answer'],
                        ['id' => 'reject_call', 'text' => 'رفض', 'icon' => 'ic_call_end']
                    ],
                    'android_sound' => getFile('assets/incoming_call.mp3'),  // نغمة مخصصة للـ Android
                    'priority' => 10,  // أولوية عالية لجعل الإشعار يظهر فورًا
                ],
                'headers' => [
                    'Authorization' => $this->apiKey,
                    'Content-Type' => 'application/json'
                ]
            ];

            $response = $this->client->post($this->apiUrl, $payload);

            return json_decode($response->getBody()->getContents(), true);

        } catch (RequestException $e) {

            return false;
        }
    }



    /**
     * إرسال إشعار إلى جميع المستخدمين
     */
    public function sendNotificationToAll($title, $message, $url = null, $data = [])
    {
        try {
            $payload = [
                'json' => [
                    'app_id' => $this->appId,
                    'included_segments' => ['All'],
                    'headings' => ['en' => $title],
                    'contents' => ['en' => $message],
                    'url' => $url,
                    'data' => $data,
                ],
                'headers' => [
                    'Authorization' => $this->apiKey, // 'Basic ' . $this->apiKey,
                    'Content-Type' => 'application/json'
                ]
            ];

            $response = $this->client->post($this->apiUrl, $payload);

            return json_decode($response->getBody()->getContents(), true);

        } catch (RequestException $e) {
            Log::error("OneSignal notification failed: " . $e->getMessage());
            return false;
        }
    }
}
