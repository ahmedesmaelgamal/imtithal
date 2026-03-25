<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\Web\AuthService as ObjService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(

        protected ObjService $objService,

    )
    {
    }

    public function index()
    {
        try {
            return $this->objService->index();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }

    }

    public function login(Request $request)
    {
        try {
            return $this->objService->login($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }

    }


    public function logout()
    {
        try {
            return $this->objService->logout();
        } catch (
        \Exception $e) {
            return self::ExeptionResponse();
        }

    }

    public function sendOtp(Request $request)
    {

        try {
            return $this->objService->sendOtp($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();

        }

    }

    public function newPassword(Request $request)
    {

        try {
            return $this->objService->newPassword($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();

        }

    }

    public function forgetPassword()
    {

        try {
            return $this->objService->forgetPassword();
        } catch (\Exception $e) {
            return self::ExeptionResponse();

        }

    }

    public function updatePassword(Request $request)
    {

        try {
            return $this->objService->updatePassword($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();

    }}
}
