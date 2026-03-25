<?php

namespace App\Http\Controllers\Agora;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OneSignal\OneSignalService;
use Illuminate\Http\Request;
use App\Services\Agora\AgoraService;

class AgoraController extends Controller
{
    protected $agoraService;

    public function __construct(AgoraService $agoraService,protected OneSignalService $oneSignalService)
    {
        $this->agoraService = $agoraService;
    }

    /**
     * 🟢 استعلام المشاريع المتاحة في حسابك على Agora
     */
    public function getProjects()
    {
        return response()->json($this->agoraService->getProjects());
    }

    public function getAllChannels()
    {
        return response()->json($this->agoraService->getAllChannels());
    }

    /**
     * 🟢 توليد توكن RTC
     */
    public function getToken(Request $request)
    {
        $user = auth('user')->user();
        $toUser = User::find($request->user_id);
        $channelName = 'ch_token' . time();

        $data = $this->agoraService->generateToken($channelName);
        $token = $data['token'];
        $dataOnSignal = [
            'type' => 'agora',
            'channel_name' => $channelName,
            'token' => $token,
            'from_user_id' => $user->id,
            'user_name' => $user->full_name,
            'user_image'=> getFile($user->image)
        ];
        $this->oneSignalService->sendIncomingCallNotification($toUser->fcm_token, $user->full_name,null,$dataOnSignal);

        return response()->json([
            'token' => $token,
            'channel_name' => $channelName,
            'from_user_id' => $user->id,
            'to_user_id' => $toUser->id
        ]);
    }
}
