<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Auth;
use App\PI;
use App\Degree;
use App\DegreeDetail;
use App\Industry;
use Hash;

class EmployeeController extends Controller
{
    public function getdetail()
    {
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        $employee = Employee::find(Auth::guard('employee')->user()->id);

        $dh_count = $pi->degreedetails->where('degree_id', 1)->count();
        $ths_count = $pi->degreedetails->where('degree_id', 2)->count();
        $ts_count = $pi->degreedetails->where('degree_id', 3)->count();
        return view('employee.pi.pi-detail', compact('pi', 'employee', 'dh_count', 'ths_count', 'ts_count'));
    }
    public function getupdate()
    {
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        return view('employee.pi.pi-update', compact('pi'));
    }
    public function postupdate(Request $request)
    {
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);

        //post data
        $request->validate(
            [
                'full_name'=> 'required|min:4|max:60',
                'nation'=> 'required',
                'date_of_birth'=>'required|date',
                'place_of_birth'=> 'required|min:5|max:100',
                'permanent_address'=> 'required|min:6|max:100',
                'contact_address'=> 'required|min:6|max:100',
                'phone_number'=> 'required',
                'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
                'position'=> 'required',
                'date_of_recruitment' => 'required|date',
                'professional_title'=> 'required',
                'identity_card'=> 'required|unique:personalinformations,identity_card,'.$pi->id,
                'date_of_issue' => 'required|date',
                'place_of_issue'=> 'required|min:5|max:100'
            ],
            [
                'employee_code.required'=> 'Mã giảng viên không được bỏ trống',
                'employee_code.unique'=> 'Mã giảng viên đã tồn tại',
                'full_name.required' =>'Họ và tên không được bỏ trống',
                'full_name.min' =>'Họ và tên phải lớn hơn 4 kí tự',
                'full_name.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
                'nation.required' =>'Dân tộc không được bỏ trống',
                'date_of_birth.required' =>'Ngày sinh không được bỏ trống',
                'date_of_birth.date' =>'Ngày sinh sai định dạng',
                'place_of_birth.min' =>'Nơi sinh phải lớn hơn 5 kí tự',
                'place_of_birth.max' =>'Nơi sinh phải nhỏ hơn 100 kí tự',
                'place_of_birth.required' =>'Nơi sinh không được bỏ trống',
                'permanent_address.min' =>'Địa chỉ thường trú phải lớn hơn 6 kí tự',
                'permanent_address.max' =>'Địa chỉ thường trú phải nhỏ hơn 100 kí tự',
                'permanent_address.required' =>'Địa chỉ thường trú không được bỏ trống',
                'contact_address.min' =>'Địa chỉ liên hệ phải lớn hơn 6 kí tự',
                'contact_address.max' =>'Địa chỉ liên hệ phải nhỏ hơn 100 kí tự',
                'contact_address.required' =>'Địa chỉ liên hệ không được bỏ trống',
                'phone_number.required' =>'Số điện thoại không được bỏ trống',
                'email_address.required' =>'Email không được bỏ trống',
                'email_address.email' =>'Email sai định dạng',
                'email_address.unique' =>'Email đã được sử dụng',
                'position.required' =>'Chức vụ không được bỏ trống',
                'date_of_recruitment.required' =>'Ngày tuyển dụng không được bỏ trống',
                'date_of_recruitment.date' =>'Ngày tuyển dụng sai định dạng',
                'professional_title.required' =>'Chức danh chuyên môn không được bỏ trống',
                'identity_card.unique' =>'Chứng minh nhân dân đã được sử dụng',
                'identity_card.required' =>'Chứng minh nhân dân không được bỏ trống',
                'date_of_issue.required' =>'Ngày cấp không được bỏ trống',
                'date_of_issue.date' =>'Ngày cấp sai định dạng',
                'place_of_issue.min' =>'Nơi cấp phải lớn hơn 5 kí tự',
                'place_of_issue.max' =>'Nơi cấp phải nhỏ hơn 100 kí tự',
                'place_of_issue.required' =>'Nơi cấp không được bỏ trống'
            ]
        );
        //post data


        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation= $request->nation;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        $pi->permanent_address= $request->permanent_address;
        $pi->contact_address= $request->contact_address;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->position= $request->position;
        $pi->date_of_recruitment= $request->date_of_recruitment;
        $pi->professional_title= $request->professional_title;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        //validate data

        $pi->save();


        return redirect()->back()->with('message', 'Cập Nhật thành công');
    }
    public function getupdatedegree()
    {
        $degrees = Degree::all();
        $industries = Industry::all();
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);

        return view('employee.pi.pi-updatedegree', compact('degrees', 'industries', 'pi'));
    }
    public function postupdatedegree(Request $request)
    {
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        $request->validate(
            [
                'date_of_issue'=> 'required|date',
                'place_of_issue'=> 'required',
                'degree'=> 'required',
                'industry'=> 'required'
            ],
            [
                'date_of_issue.required' => 'Ngày cấp không được bỏ trống',
                'date_of_issue.date' => 'Ngày cấp không đúng định dạng',
                'degree.required' => 'Bằng cấp không được bỏ trống',
                'industry.required' => 'Khối ngành không được bỏ trống',
                'place_of_issue.required' => 'Nơi cấp không được bỏ trống'
            ]
        );
        $degree_detail = new DegreeDetail;
        $degree_detail->personalinformation_id = $pi->id;
        $degree_detail->date_of_issue = $request->date_of_issue;
        $degree_detail->place_of_issue = $request->place_of_issue;
        $degree_detail->degree_id = $request->degree;
        $degree_detail->industry_id = $request->industry;

        $degree_detail->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
    public function getchangepass()
    {
        //$employee = Employee::all();
        $employee = Employee::find(Auth::guard('employee')->user()->id);
        return view('employee.pi.pi-changepass', compact('employee'));
    }
    public function postchangepass(Request $request)
    {
        $employee = Employee::find(Auth::guard('employee')->user()->id);
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        $request->validate(
            [
                'password'=> 'required',
                'newpassword'=> 'required|min:5|max:50',
                'comfirmpassword'=> 'required|same:newpassword'
            ],
            [
                'password.required' => 'chưa xác nhận Mật khẩu cũ',
                'newpassword.required' => 'Mật khẩu mới không được bỏ trống',
                'newpassword.min' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự',
                'newpassword.max' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự',
                'comfirmpassword.required' => 'Xác nhận mật khẩu mới không được bỏ trống',
                'confirmpassword.same' =>'Xác nhận mật khẩu mới không chính xác',

            ]
        );
        if (Hash::check($request->password, $employee->password)) {

                $employee->password = Hash::make(($request->newpassword));
                $employee->save();
                return redirect()->back()->with('message', 'Đổi mật khẩu thành công');

        } else {
            return redirect()->back()->with('error_message', 'Mật khẩu cũ không chính xác');
        }
    }
}
