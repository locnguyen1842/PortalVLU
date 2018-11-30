<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PI;
use App\Employee;
use Hash;
class PIController extends Controller
{
    public function index(){

      $search =  \Request::get('search');
      $pis = PI::where(function($query) use ($search){
            if($search != null){
                $query->where(function($q) use ($search){
                    $q->where('employee_code','like','%'.$search.'%');
                });

            }

        })->orderBy('first_name','decs')->paginate(10)->appends(['search'=>$search]);
      return view('pi.pi-list',compact('pis','search'));
    }
    public function getAdd()
    {
        return view('pi.pi-add');
    }
    public function postAdd(Request $request)
    {

      

        $pi = new PI;
        $pi->id= $request->id;
        $pi->employee_code= $request->employee_code;

        // $full_name = " ".$request->full_name;
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
        $pi->save();
        $employee = new Employee;
        $employee->personalinformation_id = $pi->id;
        $employee->username= $pi->employee_code;
        $employee->password = Hash::make($pi->employee_code);

        $employee->save();

        return redirect()->back();
    }
    //get data personal information
    public function getupdate($id){
        $pi = PI::Find($id);
        Return view('pi.pi-update',compact('pi'));
    }
    //post date update information
    public function postupdate(Request $request ,$id){


        //post data
        $pi = PI::Find($id);
        $request->validate([
            'full_name'=> 'required|string|min:4|max:60',
            'nation'=> 'required|string',
            'place_of_birth'=> 'required|string|min:6|max:100',
            'permanent_address'=> 'required|string|min:6|max:100',
            'contact_address'=> 'required|string|min:6|max:100',
            'phone_number'=> 'required',
            'email_address'=> 'required|string|email|unique:personalinformations,email_address,'.$pi->id,
            'position'=> 'required|string',
            'professional_title'=> 'required|string',
            'identity_card'=> 'required|unique:personalinformations,identity_card,'.$pi->id,
            'place_of_issue'=> 'required|string|min:6|max:100'
        ],
            [
                'full_name.required' =>'Họ và tên không được bỏ trống',
                'full_name.string' =>'Họ và tên phải là chữ',
                'full_name.min' =>'Họ và tên phải lớn hơn 4 kí tự',
                'full_name.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
                'place_of_birth.min' =>'Nơi sinh phải lớn hơn 6 kí tự',
                'place_of_birth.max' =>'Nơi sinh phải nhỏ hơn 100 kí tự',
                'permanent_address.min' =>'Địa chỉ thường trú phải lớn hơn 6 kí tự',
                'permanent_address.max' =>'Địa chỉ thường trú phải nhỏ hơn 100 kí tự',
                'contact_address.min' =>'địa chỉ liên hệ phải lớn hơn 6 kí tự',
                'contact_address.max' =>'địa chỉ liên hệ phải nhỏ hơn 100 kí tự',
                'place_of_issue.min' =>'Nơi cấp phải lớn hơn 6 kí tự',
                'place_of_issue.max' =>'Nơi cấp phải nhỏ hơn 100 kí tự',
                'nation.string' =>'Dân tộc phải là chữ',
                'nation.required' =>'Dân tộc không được bỏ trống',
                'place_of_birth.string' =>'Nơi sinh phải là chữ',
                'place_of_birth.required' =>'Nơi sinh không được bỏ trống',
                'permanent_address.string' =>'Địa chỉ thường trú phải là chữ',
                'permanent_address.required' =>'Địa chỉ thường trú không được bỏ trống',
                'contact_address.string' =>'địa chỉ liên hệ phải là chữ',
                'contact_address.required' =>'địa chỉ liên hệ không được bỏ trống',
                'email_address.string' =>'email phải là chữ',
                'email_address.required' =>'email không được bỏ trống',
                'position.string' =>'chức vụ phải là chữ',
                'position.required' =>'chức vụ không được bỏ trống',
                'professional_title.string' =>'Chức danh chuyên môn phải là chữ',
                'professional_title.required' =>'Chức danh chuyên môn không được bỏ trống',
                'place_of_issue.string' =>'Nơi cấp phải là chữ',
                'place_of_issue.required' =>'Nơi cấp không được bỏ trống',
                'phone_number.required' =>'phone number không được bỏ trống',
                'email_address.email' =>'email sai định dạng',
                'email_address.unique' =>'email được sử dụng',
                'identity_card.unique' =>'Chứng minh nhân dân đã được sử dụng'
            ]
        );
        //post data
        $pi->id= $request->id;
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

}
