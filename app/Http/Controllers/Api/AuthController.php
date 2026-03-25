<?php

/**
 * Summary of namespace App\Http\Controllers\Api
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AuthService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ladumor\OneSignal\OneSignal;

/**
 * Summary of AuthController
 */
class  AuthController extends Controller
{
    /**
     * Summary of __construct
     * @param \App\Services\Api\AuthService $authService
     */
    public function __construct(protected AuthService $authService)
    {
    }

    /**
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
         try {
            return $this->authService->login($request);
         } catch (\Exception $e) {
             return self::ExeptionResponse();
         }

    }

    /**
     * Summary of sendOtp
     * @param \Illuminate\Http\Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
       try {
            return $this->authService->sendOtp($request);
       } catch (\Exception $e) {
           return self::ExeptionResponse();
       }
    }

    /**
     * Summary of checkOtp
     * @param \Illuminate\Http\Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function checkOtp(Request $request)
    {
        try {
            return $this->authService->checkOtp($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    /**
     * Summary of updatePassword
     * @param \Illuminate\Http\Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        try {
            return $this->authService->updatePassword($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


    public function deleteAccount(Request $request)
    {
        try {
            return $this->authService->deleteAccount($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }

    }

    public function authData()
    {
        try {
            return $this->authService->authData();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getPrivacyPolicy(Request $request)
    {
        try {
            return $this->authService->getPrivacyPolicy($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function deleteImage()
    {
        try {
            return $this->authService->deleteImage();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getUserNotificationsOrAlerts()
    {
//        try {
            return $this->authService->getUserNotificationsOrAlerts();
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    }

    public function MarkAsRead(Request $request)
    {
        try {
            return $this->authService->MarkAsRead($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            return $this->authService->updateProfile($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getDeleteReasons()
    {
        try {
            return $this->authService->getDeleteReasons();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


    public function logout()
    {
//        try {
            return $this->authService->logout();
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    }

    public function getAxesByAuth()
    {
        try {
            return $this->authService->getAxesByAuth();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getAreaByAxis($axis_id)
    {
        try {
            return $this->authService->getAreaByAxis($axis_id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getTeamByArea($area_id)
    {
       try {
            return $this->authService->getTeamByArea($area_id);
       } catch (\Exception $e) {
           return self::ExeptionResponse();
       }
    }

    public function getDailyReportByAxis($axis_id)
    {
        try {
            return $this->authService->getDailyReportByAxis($axis_id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }










}
