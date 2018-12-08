<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;


class AdminForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker(){
        return Password::broker('admins');
    }

    public function showLinkRequestForm()
    {

          return view('admin.admin-forgotpassword');
    }
    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', 'Yêu cầu khôi phục mật khẩu thành công. Vui lòng kiểm tra email!');
    }
    protected function sendResetLinkFailedResponse($response)
    {
        return back()->with('error', 'Email không tồn tại.');
    }
}
