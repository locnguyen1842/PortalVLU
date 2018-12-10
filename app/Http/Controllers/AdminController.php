<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Auth;
use App\PI;
Use App\Admin;
use App\Degree;
use App\DegreeDetail;
use App\Industry;
use Hash;

class AdminController extends Controller
{
    //
    public function getchangepass()
    {
        //$admin = admin::all();
        $admin = admin::find(Auth::guard('admin')->user()->id);
        return view('admin.admin-changepass', compact('admin'));
    }
    public function postchangepass(Request $request)
    {
        $admin = admin::find(Auth::guard('admin')->user()->id);
        $pi = PI::find(Auth::guard('admin')->user()->personalinformation_id);
        $request->validate(
            [
                'password'=> 'required',
                'newpassword'=> 'required|min:5|max:50',
                'comfirmpassword'=> 'required|same:newpassword'
            ],
            [
                'password.required' => 'Chưa xác nhận mật khẩu cũ',
                'newpassword.required' => 'Mật khẩu mới không được bỏ trống',
                'newpassword.min' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự',
                'newpassword.max' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự',
                'comfirmpassword.required' => 'Xác nhận mật khẩu mới không được bỏ trống',
                'comfirmpassword.same' =>'Xác nhận mật khẩu mới không chính xác',

            ]
        );
        if (Hash::check($request->password, $admin->password)) {

            $admin->password = Hash::make(($request->newpassword));
            $admin->save();
            return redirect()->back()->with('message', 'Đổi mật khẩu thành công');

        } else {
            return redirect()->back()->with('error_message', 'Mật khẩu cũ không chính xác');
        }
    }
}
