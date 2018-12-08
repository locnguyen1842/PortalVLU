<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Auth;
use Password;

class EmployeeResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:employee');
    }

    protected function guard()
    {
        return Auth::guard('employee');
    }

    protected function broker()
    {
        return Password::broker('employees');
    }
    protected function validationErrorMessages()
    {
       return [
         'token.required'    => 'Yêu cầu khôi phục mật khẩu không hợp lệ',
         'email.required'    => 'Email không được bỏ trống',
         'email.email'       => 'Email không đúng định dạng',
         'password.required' => 'Mật khẩu không được để trống',
         'password.confirmed' => 'Mật khẩu nhập lại không trùng khớp với mật khẩu mới',
         'password.min' => 'Mật khẩu phải có độ dài từ 5-50 ký tự',
         'password.max' => 'Mật khẩu phải có độ dài từ 5-50 ký tự',
       ];
    }
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())
                            ->with('status', trans('Đổi mật khẩu thành công'));
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Email không hợp lệ']);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('employee.employee-reset')->with(
              ['token' => $token, 'email' => $request->email]
          );
    }
}
