<?php

namespace App\Services\Web;


use App\Mail\OtpMail;
use App\Models\Admin;

use App\Services\BaseService;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


/**
 * Summary of AuthService
 */
class AuthService extends BaseService
{


    public function __construct(Admin $objModel)
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        return view('web.auth.login');

    }

    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'input' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('input', 'password');
        $admin = $this->model->where('email', $credentials['input'])->orWhere('national_id', $credentials['input'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return redirect()->back()->with('error', 'البريد الإلكتروني او رقم الهويه أو كلمة المرور غير صحيحة');
        }
        elseif ($admin->status!==1){
            return redirect()->back()->with('error', 'حسابك غير مفعل يرجى التواصل مع مدير النظام الرئيسي');
        }

        // Login admin
        auth()->guard('web')->login($admin);

        return redirect()->route('adminHome');
    }

    public function forgetPassword()
    {

        return view('web.auth.forget_password');
    }


    public function sendOtp($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $admin = $this->model->where('email', $request->email)->first();
        $admin->otp = rand(1000, 9999);
        $admin->otp_expire = now()->addMinutes(5);
        $admin->save();
        // send mail
        Mail::to($admin->email)->send(new OtpMail($admin->otp));

        return view('web.auth.otp', [
            'email' => $admin->email,
            'otp' => $admin->otp,
            'otp_expire' => $admin->otp_expire
        ]);

    }

    public function newPassword($request)
    {
        return view('web.auth.new_password', [
            'email' => $request->email
        ]);

    }


    public function updatePassword($request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'email' => 'required|email|exists:admins,email',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $admin = $this->model->where('email', $request->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.login')->with('success', 'تم تحديث كلمة المرور بنجاح');


    }


    public function logout()
    {

        //logout admin
        auth()->guard('web')->logout();

        return redirect()->route('admin.login');

    }


}
