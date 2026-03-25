<?php

namespace App\Traits;

use App\Models\Alert;
use App\Models\AlertLeader;
use App\Models\AlertUser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Exception;

trait OneSignalNotification
{
    protected Client $client;
    protected mixed $appId;
    protected mixed $apiKey;
    protected mixed $apiUrl;

    public function initializeOneSignalTrait(): void
    {
        $this->client = new Client();
        $this->appId = env('ONESIGNAL_APP_ID');
        $this->apiKey = env('ONESIGNAL_API_KEY');
        $this->apiUrl = env('ONESIGNAL_API_URL', 'https://api.onesignal.com/notifications');

        if (empty($this->appId) || empty($this->apiKey)) {
            Log::warning("ONESIGNAL_APP_ID and ONESIGNAL_API_KEY must be set in the .env file");
        }
    }

    /**
     * إرسال إشعار إلى مستخدم معين باستخدام Player ID
     */
    public function sendNotificationToUser($playerId, $title, $message, $url = null, $data = []): bool|array
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
                    'Authorization' => 'Basic ' . $this->apiKey,
                    'Content-Type' => 'application/json'
                ]
            ];

            $alart = Alert::create([
                'title' => $title,
                'body' => $message,
                'leader_id' => $data['user_id'] ?? null,
                'type' => 'notification',
                'user_type' => $data['user_type'],
                'notification_type' => $data['notification_type'],
            ]);
            if ($data['user_type'] == 'leader') {
                AlertLeader::create([
                    'alert_id' => $alart->id,
                    'leader_id' => $data['user_id'],
                    'seen' => '0'
                ]);

            } else {
                AlertUser::create([
                    'alert_id' => $alart->id,
                    'user_id' => $data['user_id'],
                    'seen' => '0'
                ]);
            }

            $response = $this->client->post($this->apiUrl, $payload);

            return json_decode($response->getBody()->getContents(), true);

        } catch (RequestException $e) {
            Log::error("OneSignal notification failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * إرسال إشعار إلى جميع المستخدمين
     */
    public function sendNotificationToAll($title, $message, $url = null, $data = []): bool|array
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
                    'Authorization' => 'Basic ' . $this->apiKey,
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
