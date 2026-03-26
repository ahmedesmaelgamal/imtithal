<?php

namespace App\Services\Api;

use App\Enum\DeleteReasonEnum;
use App\Http\Resources\AlertResource;
use App\Http\Resources\Leaders\DailyReportResource;
use App\Http\Resources\Leaders\LeaderResource;
use App\Http\Resources\Leaders\TeamByAreaResource;
use App\Http\Resources\Leaders\TeamResource;
use App\Http\Resources\PrivacyPolicyResource;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\AxisResource;
use App\Http\Resources\Users\UserResource;
use App\Mail\OtpMail;
use App\Models\Alert;
use App\Models\AlertLeader;
use App\Models\AlertUser;
use App\Models\Area;
use App\Models\AreaTeam;
use App\Models\Axis;
use App\Models\DailyReport;
use App\Models\PolicyPrivacy;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Ladumor\OneSignal\OneSignal;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Summary of AuthService
 */
class AuthService extends BaseService
{


    public function __construct(User $objModel, protected DailyReport $dailyReport, protected PolicyPrivacy $policyPrivacy, protected AreaTeam $areaTeam, protected Area $area, protected Axis $axis, protected AlertUser $alertUser, protected Alert $alert, protected AlertLeader $alertLeader)
    {
        parent::__construct($objModel);
    }

    public function login($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'national_or_email' => 'required',
            'password' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }

        $user = User::where('national_id', $request->national_or_email)
            ->orWhere('email', $request->national_or_email)
            ->first();

        if (!$user) {
            return $this->responseMsg('لا يمكن العثور على الموظف', null, 422);
        }

        if ($user->status == 0) {
            return $this->responseMsg('حسابك غير نشط، يرجى الاتصال بالمسؤول', null, 422);
        }

        $token = Auth::guard('user')->attempt([
            'national_id' => $user->national_id,
            'password' => $request->password
        ]);


        if ($token) {
            $user->jwt_token = 'Bearer ' . $token;
            $user->save();
            return $this->responseMsg('تم تسجيل الدخول ', LeaderResource::make($user));
        } else {
            return $this->responseMsg('فشل تسجيل الدخول، تحقق من بيانات الاعتماد الخاصة بك', null, 422);
        }
    }

    /**
     * Summary of sendOtp
     * @param mixed $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function sendOtp($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($validator) {
            return $validator;
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->responseMsg('لا يمكن العثور على الموظف', null, 422);
        }
        if ($user->otp_expire > now()) {
            return $this->responseMsg('تم إرسال OTP بالفعل', null, 422);
        }
        $user->otp = rand(1000, 9999);
        $user->otp_expire = now()->addMinutes(3);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($user->otp));

        return $this->responseMsg('تم إرسال Otp بنجاح', ['otp' => $user->otp]);
    }

    /**
     * Summary of checkOtp
     * @param mixed $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function checkOtp($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'phone' => 'required|exists:users,phone',
            'otp' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }
        $user = User::where('phone', $request->phone)->first();
        if ($user->otp == $request->otp && $user->otp_expire > now()) {
            $user->otp = null;
            $user->save();
            return $this->responseMsg('تمت مطابقة OTP بنجاح', null);
        } else {
            return $this->responseMsg('OTP غير متطابق', null, 422);
        }
    }

    /**
     * Summary of updatePassword
     * @param mixed $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function updatePassword($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'email' => 'required',
            'password' => 'required|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&#]/',
        ], [
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف',
            'password.regex' => 'كلمة المرور يجب أن تحتوي على حرف صغير واحد على الأقل، وحرف كبير واحد على الأقل، و رقم واحد على الأقل، ورمز واحد على الأقل (@$!%*?&#)',
        ]);

        if ($validator) {
            return $validator;
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->responseMsg('لا يمكن العثور على الموظف', null, 422);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->responseMsg('تم تحديث كلمة المرور بنجاح', null);
    }

    public function deleteAccount($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'delete_reason' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }

        $user = auth()->guard('user')->user() ?? auth()->guard('user')->user();
        $user->delete_reason = $request->delete_reason;
        $user->status = 0;
        $user->save();
        $user->delete();
        return $this->responseMsg('تم حذف الحساب بنجاح', null);
    }

    public function deleteImage()
    {
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        if ($user->image) {
            $this->deleteFile($user->image);
        }
        $user->image = null;
        $user->save();
        return $this->responseMsg('تم حذف الصورة بنجاح', LeaderResource::make($user));
    }

    public function getDeleteReasons()
    {
        // Get all cases from the enum
        $deleteReasons = DeleteReasonEnum::cases();

        // Map cases to an array of value and lang
        $reasonsArray = array_map(function ($reason) {
            return [
                'id' => $reason->value,
                'name' => $reason->lang(),
            ];
        }, $deleteReasons);

        // Return the response with the formatted array
        return $this->responseMsg('تمت العملية بنجاح', $reasonsArray);
    }


    public function authData()
    {
        $user = auth()->guard('user')->user();
        return $this->responseMsg('تمت العملية بنجاح', new UserResource($user));
    }

    public function getPrivacyPolicy($request)
    {
        $data = $this->policyPrivacy->where('type', $request->type)->get();
        return $this->responseMsg('تمت العملية بنجاح', PrivacyPolicyResource::collection($data));
    }


    public function getUserNotificationsOrAlerts()
    {
        $user = auth('user')->user();
        $role = $user->getRoleNames()->first();
        $alertIds = $role == 'مشرف'
            ? $this->alertLeader->where('leader_id', $user->id)->get()
            : $this->alertUser->where('user_id', $user->id)->get();
        $alerts = $this->alert->whereIn('id', $alertIds->pluck('alert_id'))->get();

        if ($alerts->isEmpty()) {
            return $this->responseMsg('لا يوجد تنبيهات', null);
        }

        $resource = $role == 'مشرف' ? AlertResource::collection($alerts) : AlertResource::collection($alerts);
        return $this->responseMsg('تمت العملية بنجاح', $resource);
    }

    public function MarkAsRead($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'alert_id' => 'nullable|exists:alerts,id',
        ]);

        if ($validator) {
            return $validator;
        }

        $user = auth('user')->user();
        $role = $user->getRoleNames()->first();
        $alertModel = $role == 'مشرف' ? $this->alertLeader : $this->alertUser;
        $userIdField = $role == 'مشرف' ? 'leader_id' : 'user_id';

        if (!$request->alert_id) {
            $alerts = $alertModel->where($userIdField, $user->id)->get();
            foreach ($alerts as $alert) {
                $alertModel->where('alert_id', $alert->alert_id)
                    ->where($userIdField, $user->id)
                    ->update(['seen' => 1]);
            }
        } else {
            $alertModel->where('alert_id', $request->alert_id)
                ->where($userIdField, $user->id)
                ->update(['seen' => 1]);
        }

        return $this->responseMsg('تمت العملية بنجاح', null);
    }

    public function updateProfile($request)
    {
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image = $this->handleFile($image, 'user');
            if ($user->image) {
                $this->deleteFile($user->image);
            }
            $user->image = $image;
            $user->save();
        }
        return $this->responseMsg('تم التعديل بنجاح', LeaderResource::make($user));
    }

    public function getAxesByAuth()
    {
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        $area_ids = $user->areas->pluck('area_id')->toArray();
        $axes = $this->area->whereIn('id', $area_ids)->pluck('axis_id')->toArray();
        $axes = $this->axis->whereIn('id', $axes)->get();
        return $this->responseMsg('تمت العملية بنجاح', AxisResource::collection($axes));
    }

    public function getAreaByAxis($axis_id)
    {
        $areas = $this->area->where('axis_id', $axis_id)->get();
        return $this->responseMsg('تمت العملية بنجاح', AreaResource::collection($areas));
    }

    public function getTeamByArea($area_id)
    {
        $userIds = $this->areaTeam->where('area_id', $area_id)->where('type', 0)->pluck('user_id')->unique();
        $teams = $this->model->whereIn('id', $userIds)->get();
        return $this->responseMsg('تمت العملية بنجاح', TeamResource::collection($teams));
    }

    public function getDailyReportByAxis($axis_id)
    {
        $dailyReports = $this->dailyReport->where('axis_id', $axis_id)->get();
        return $this->responseMsg('تمت العملية بنجاح', DailyReportResource::collection($dailyReports));
    }

    /**
     * Summary of logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = Auth::guard('user')->user();

        $user->fcm_token = null;
        $user->save();

        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        Auth::guard('user')->logout();


        return $this->responseMsg('تم تسجيل الخروج', null);
    }
}
