<?php

namespace App\Http\Controllers\OneSignal;

use App\Http\Controllers\Controller;
use App\Services\OneSignal\OneSignalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OneSignalController extends Controller
{
    protected $oneSignalService;

    public function __construct(OneSignalService $oneSignalService)
    {
        $this->oneSignalService = $oneSignalService;
    }

    /**
     * إرسال إشعار إلى مستخدم معين
     */
    public function sendToUser(Request $request): JsonResponse
    {
        $playerId = $request->input('player_id');
        $title = $request->input('title');
        $message = $request->input('message');
        $url = $request->input('url');
        $data = $request->input('data', []);

        $response = $this->oneSignalService->sendNotificationToUser($playerId, $title, $message, $url, $data);

        if (!$response) {
            return response()->json(['error' => 'Failed to send notification'], 500);
        }

        return response()->json($response);
    }

    /**
     * إرسال إشعار إلى جميع المستخدمين
     */
    public function sendToAll(Request $request): JsonResponse
    {
        $title = $request->input('title');
        $message = $request->input('message');
        $url = $request->input('url');
        $data = $request->input('data', []);

        $response = $this->oneSignalService->sendNotificationToAll($title, $message, $url, $data);

        if (!$response) {
            return response()->json(['error' => 'Failed to send notification'], 500);
        }

        return response()->json($response);
    }
}
