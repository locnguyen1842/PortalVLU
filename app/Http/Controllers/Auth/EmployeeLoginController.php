<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class EmployeeLoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest:employee',['except' => ['logout']]);
    }

    public function showLoginForm(){
        return view('employee.employee-login');
    }
    public function login(Request $request){
      if (Auth::guard('employee')->attempt(['username'=> $request->username ,'password' => $request->password],$request->remember)) {
        if(Auth::guard('employee')->user()->pi->show == 0){
          Auth::guard('employee')->logout();
          return redirect()->back()->with('error_message','Tài khoản hoặc mật khẩu không đúng.');
        }else{
          return redirect()->route('employee.pi.detail');
        }

      }
      return redirect()->back()->with('error_message','Tài khoản hoặc mật khẩu không đúng.');

    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
}
