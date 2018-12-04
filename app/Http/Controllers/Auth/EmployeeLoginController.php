<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EmployeeLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:employee',['except' => ['logout']]);
    }

    public function showLoginForm(){
        return view('employee.employee-login');
    }
    public function login(Request $request){
        // $this->validate($request, [
        //         'email' => 'email|required',
        //         'password' => 'required',
        //     ],
        //     [
        //         'email.required' => 'Vui lòng điền email.',
        //         'email.email' => 'Không đúng định dạng email.',
        //         'password.required' => 'Vui lòng điền mật khẩu.',
        //     ]
        // );

        //login
        if(Auth::guard('employee')->attempt(['username'=> $request->username,'password'=>$request->password],$request->remember)){
            return redirect()->route('employee.pi.detail');
        }
        return redirect()->back()->with('message_error','Email hoặc mật khẩu không đúng.');

    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }

    public function username(){
      return 'username';
    }
}
