<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminLoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin',['except' => ['logout']]);
    }
    public function showLoginForm(){
        return view('admin.admin-login');
    }
    public function login(Request $request){

        if (Auth::guard('admin')->attempt(['username'=> $request->username ,'password' => $request->password],$request->remember)) {
          return redirect()->route('admin.pi.index');
        }
        return redirect()->back()->with('error_message','Tài khoản hoặc mật khẩu không đúng.');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



}
