<?php

namespace App\Services\Agora;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use TaylanUnutmaz\AgoraTokenBuilder\RtcTokenBuilder;
use Carbon\Carbon;

class AgoraService
{
    protected $client;
    protected $baseUrl;
    protected $appId;
    protected $appCertificate;
    protected $customerKey;
    protected $customerSecret;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'https://api.agora.io/dev/v1';
        $this->appId = env('AGORA_APP_ID');
        $this->appCertificate = env('AGORA_APP_CERTIFICATE');
        $this->customerKey = env('AGORA_CUSTOMER_KEY');
        $this->customerSecret = env('AGORA_CUSTOMER_SECRET');
    }

    /**
     * 🟢 استعلام عن المشاريع في حسابك على Agora
     */
    public function getProjects()
    {
        try {
            $credentials = "{$this->customerKey}:{$this->customerSecret}";
            $base64Credentials = base64_encode($credentials);

            $url = "{$this->baseUrl}/projects";
            $response = $this->client->get($url, [
                'headers' => [
                    'Authorization' => "Basic {$base64Credentials}",
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("❌ خطأ أثناء جلب المشاريع من Agora: " . $e->getMessage());
            return ['error' => 'فشل في جلب المشاريع'];
        }
    }

    /**
     * 🟢 استعلام جميع القنوات النشطة
     */
    public function getAllChannels()
    {
        try {
            $credentials = "{$this->customerKey}:{$this->customerSecret}";
            $base64Credentials = base64_encode($credentials);

            $url = "{$this->baseUrl}/channel/{$this->appId}";
            $response = $this->client->get($url, [
                'headers' => [
                    'Authorization' => "Basic {$base64Credentials}",
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("❌ خطأ أثناء جلب القنوات من Agora: " . $e->getMessage());
            return ['error' => 'فشل في جلب القنوات'];
        }
    }

    /**
     * 🟢 توليد توكن RTC لاستخدامه في الاتصال الصوتي/الفيديو
     */
    public function generateToken($channelName, $uid=0)
    {
        try {
            $token = RtcTokenBuilder2::buildTokenWithUid($this->appId, $this->appCertificate, $channelName, 0, RtcTokenBuilder2::ROLE_PUBLISHER, 3600);
            return [
                'channel' => $channelName,
                'uid' => $uid,
                'token' => $token
            ];
        } catch (\Exception $e) {
            Log::error("❌ خطأ أثناء توليد التوكن في Agora: " . $e->getMessage());
            return ['error' => 'فشل في توليد التوكن'];
        }
    }
}
