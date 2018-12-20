<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use App\PI;


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
    public function sendResetLinkEmail(Request $request)
    {

        $pi = PI::where('employee_code',$request->employee_code)->first();

        if($pi != null && $pi->show == 1 ){
          $email = ['email'=>$pi->email_address];
          $response = $this->broker()->sendResetLink($email);

          return $response == Password::RESET_LINK_SENT
                      ? $this->sendResetLinkResponse($request, $response)
                      : $this->sendResetLinkFailedResponse($request, $response);
        }
        else{
          return $this->sendResetLinkFailedResponse($request);
        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

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
        return back()->with('error', 'Tài khoản không tồn tại.');
    }
}
