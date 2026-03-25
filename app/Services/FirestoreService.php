<?php

namespace App\Services;

use App\Models\User;
use App\Services\OneSignal\OneSignalService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FirestoreService extends BaseService
{
    protected Client $client;
    protected mixed $projectId;

    public function __construct(protected OneSignalService $oneSignalService, protected User $user)
    {
        $this->client = new Client([
            'base_uri' => 'https://firestore.googleapis.com/v1/projects/' . env('FIREBASE_PROJECT_ID') . '/databases/(default)/documents/',
        ]);

        $this->projectId = env('FIREBASE_PROJECT_ID');
    }

    public function addUser($userData)
    {
        $documentName = "users/" . $userData['national_id']; // Unique ID

        try {
            $response = $this->client->patch($documentName, [ // Use PATCH for updates
                'json' => [
                    'fields' => [
                        'user_id' => ['integerValue' => $userData['user_id']],
                        'name' => ['stringValue' => $userData['name']],
                        'email' => ['stringValue' => $userData['email']],
                        'image' => ['stringValue' => $userData['image']],
                        'national_id' => ['stringValue' => $userData['national_id']],
                        'role' => ['stringValue' => $userData['role']],
                        'created_at' => ['timestampValue' => now()->toIso8601String()],
                        'lat' => ['doubleValue' => (float)$userData['lat']],
                        'long' => ['doubleValue' => (float)$userData['long']],
                        'is_active' => ['booleanValue' => isset($userData['is_active']) ? $userData['is_active'] : false],
                        'is_active_map' => ['booleanValue' => isset($userData['is_active_map']) ? $userData['is_active_map'] : false],
                        'updated_at' => ['timestampValue' => now()->toIso8601String()]
                    ]
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Firestore Error: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function updateIsActiveUser($userData)
    {
        $documentName = "users/" . $userData['national_id']; // Unique ID

        try {
            $response = $this->client->patch($documentName.'?updateMask.fieldPaths=is_active_map&updateMask.fieldPaths=updated_at', [
                'json' => [
                    'fields' => [
                        'is_active_map' => ['booleanValue' => $userData['is_active']],
                        'updated_at' => ['timestampValue' => now()->toIso8601String()]
                    ]
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Firestore Error: ' . $e->getMessage());
            return null;
        }
    }


    public function getUsers($user_ids = [])
    {
        $documentName = "users"; // Unique ID

        try {
            $response = $this->client->get($documentName, [
                'query' => [
                    'user_ids' => implode(',', $user_ids)
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Firestore Error: ' . $e->getMessage());
            return null;
        }
    }

    public function addMessage($request)
    {
        try {
            $fileUrl = '';
            $fromUser = $this->user->where('national_id', $request->sender_id)->first();
            $toUser = $this->user->where('national_id', $request->receiver_id)->first();
            if ($request->has('file')) {
                $file = $this->handleFile($request->file('file'), 'messages');
                $fileUrl = getFile($file);

                $documentName = "messages/"; // تحديد الـ document ID بناءً على معرف المستخدم

                $response = $this->client->post($documentName, [
                    'json' => [
                        'fields' => [
                            'senderId' => ['stringValue' => $request->sender_id],
                            'receiverId' => ['stringValue' => $request->receiver_id],
                            'bodyMessage' => ['stringValue' => $request->message],
                            'chatId' => ['stringValue' => $request->chat_id],
                            'fileUrl' => ['stringValue' => $fileUrl],
                            'seen' => ['booleanValue' => false],
                            'time' => ['timestampValue' => now()->toIso8601String()],
                        ]
                    ]
                ]);

                $result = json_decode($response->getBody()->getContents(), true);

                if (!$result) {
                    return response()->json(['success' => false, 'message' => 'Failed to send message'], 500);
                }
            }
            try {
                $this->oneSignalService->sendNotificationToUser($toUser->fcm_token, 'هناك رسالة جديدة من ' . $fromUser->full_name, $request->message,null,[
                    'sender_national_id' => $fromUser->national_id,
                    'sender_user_id' => $fromUser->id,
                    'receiver_national_id' => $toUser->national_id,
                    'receiver_user_id' => $toUser->id,
                    'type' => 'message'
                ]);
            } catch (\Exception $exception) {
            }

            return $this->responseMsg('تم ارسال الرسالة بنجاح للفايربيز', $result);
        } catch (\Exception $e) {
            return $this->responseMsg('هناك مشكلة ما لا يمكن تحديدها في الوقت الحالي');
        }
    }

    public function addStats($data)
    {
        $documentName = "daily_stats/" . Carbon::now()->format('Y-m-d'); // Unique ID

        try {
            $response = $this->client->patch($documentName, [ // Use PATCH for updates
                'json' => [
                    'fields' => [
                        'users_count' => ['integerValue' => $data['users_count']],
                        'user_growth_percentage' => ['integerValue' => $data['user_growth_percentage']],
                        'daily_report_count' => ['integerValue' => $data['daily_report_count']],
                        'daily_growth_percentage' => ['integerValue' => $data['daily_growth_percentage']],
                        'reports_count' => ['integerValue' => $data['reports_count']],
                        'report_growth_percentage' => ['integerValue' => $data['report_growth_percentage']],
                        'areas_count' => ['integerValue' => $data['areas_count']],
                        'area_growth_percentage' => ['integerValue' => $data['area_growth_percentage']],
                        'updated_at' => ['timestampValue' => now()->toIso8601String()]
                    ]
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Firestore Error: ' . $e->getMessage());
            return null;
        }
    }

    public function addNotice($data)
    {
        $documentName = "high_notices/" . $data->id; // Unique ID

        try {
            $response = $this->client->patch($documentName, [
                'json' => [
                    'fields' => [
                        'notice_type' => ['stringValue' => trim($data->noticeType->priority ?? '')],
                        'notice_id'=> ['stringValue' => trim($data->id)],
                        'notice_type_name' => ['stringValue' => trim($data->noticeType->name)],
                        'lat' => ['doubleValue' => trim($data->lat ?? '')],
                        'long' => ['doubleValue' => trim($data->long ?? '')],
                        'description' => ['stringValue' => trim($data->description ?? '')],
                        'notice_time' => ['stringValue' => trim($data->notice_time ?? '')],
                        'notice_date' => ['stringValue' => trim($data->notice_date ?? '')],
                        'leader' => ['stringValue' => trim($data->leader->full_name ?? '')],
                        'status' => ['integerValue' => (int)$data->status],
                        'is_up' => ['integerValue' => isset($data->is_up) ? $data->is_up : false],
                        'user' => ['stringValue' => trim($data->user->full_name ?? '')],
                        'created_at' => ['timestampValue' => now()->toIso8601String()],
                        'updated_at' => ['timestampValue' => now()->toIso8601String()]
                    ]
                ]
            ]);


            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Firestore Error: ' . $e->getMessage());
            return null;
        }
    }

    // update notice
    public function updateNotice($data)
    {
        $documentName = "high_notices/" . $data->id; // Unique ID

        try {
            $response = $this->client->patch($documentName.'?updateMask.fieldPaths=status&updateMask.fieldPaths=updated_at&updateMask.fieldPaths=is_up', [
                'json' => [
                    'fields' => [
                        'status' => ['integerValue' => (int)$data->status],
                        'is_up' => ['integerValue' => isset($data->is_up) ? ($data->is_up == 1 ? 1 : 0)  : 0],
                        'updated_at' => ['timestampValue' => now()->toIso8601String()]
                    ]
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Firestore Error: ' . $e->getMessage());
            return null;
        }
    }
}
