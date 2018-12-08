<?php

namespace App\Http\Controllers;

use App\DegreeDetail;
use App\Industry;
use Illuminate\Http\Request;
use App\PI;
use App\Imports\AdminPIImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Employee;
use Hash;

class PIController extends Controller
{
    public function index()
    {
        //check if have any get request named 'search' then assign value to $search
        $search =  \Request::get('search');

        //query if $search have a value
        $pis = PI::where(function ($query) use ($search) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->where('employee_code', 'like', '%'.$search.'%')
                      ->orWhere('full_name', 'like', '%'.$search.'%')
                      ->orWhere('identity_card', 'like', '%'.$search.'%');
                });
            }
        })->orderBy('first_name', 'asc')->paginate(10)->appends(['search'=>$search]);

        return view('admin.pi.pi-list', compact('pis', 'search'));
    }
    public function getAdd()
    {
        return view('admin.pi.pi-add');
    }
    public function postAdd(Request $request)
    {
        $request->validate(
          [
            'employee_code'=> 'required|unique:personalinformations,employee_code',
            'full_name'=> 'required|min:4|max:60',
            'nation'=> 'required',
            'date_of_birth'=>'required|date',
            'place_of_birth'=> 'required|min:5|max:100',
            'permanent_address'=> 'required|min:6|max:100',
            'contact_address'=> 'required|min:6|max:100',
            'phone_number'=> 'required',
            'email_address'=> 'required|email|unique:personalinformations,email_address',
            'position'=> 'required',
            'date_of_recruitment' => 'required|date',
            'professional_title'=> 'required',
            'identity_card'=> 'required|unique:personalinformations,identity_card',
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
        //add data
        $pi = new PI;
        $pi->id= $request->id;
        $pi->employee_code= strtoupper($request->employee_code);

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
        //create account
        $employee = new Employee;
        $employee->personalinformation_id = $pi->id;
        $employee->username= $pi->employee_code;
        $employee->password = Hash::make($pi->employee_code);
        $employee->email = $pi->email;

        $employee->save();

        return redirect()->back()->with('message', 'Thêm thành công');
    }
    //get data personal information
    public function getupdate($id)
    {
        $pi = PI::Find($id);
        return view('admin.pi.pi-update', compact('pi'));
    }
    //post date update information
    public function postupdate(Request $request, $id)
    {


        //post data
        $pi = PI::Find($id);
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
    public function getdetail($id)
    {
        $pi = PI::find($id);
        $dh_count = $pi->degreedetails->where('degree_id', 1)->count();
        $ths_count = $pi->degreedetails->where('degree_id', 2)->count();
        $ts_count = $pi->degreedetails->where('degree_id', 3)->count();
        return view('admin.pi.pi-detail', compact('pi', 'dh_count', 'ths_count', 'ts_count'));
    }
    public function recoverypassword($employee_id)
    {
        $employee = Employee::find($employee_id);
        //strtoupper cho nó in hoa khi gõ pass
        $employee->password = Hash::make(strtoupper($employee->pi->employee_code)); //chỉ cần thay đổi trường pwd la dc

        $employee->save();
        return redirect()->back()->with('message', 'Khôi phục mật khẩu thành công');//kêu thằng sơn làm đổi pass bên employee đi may làm recovery pasửod r
    }

    public function import(Request $request)
    {
        $request->validate(
        [
          'import_file' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|file'
        ],
        [
          'import_file.requied'=> 'Vui lòng chọn file để import.',
          'import_file.mimetypes'=> 'File tải lên không đúng định dạng excel (xls,xlsx).',
          'import_file.file'=> 'Không tìm thấy file tải lên.',
        ]
      );
        if ($request->has('import_file')) {
            $file = $request->file('import_file');
            Excel::import(new AdminPIImport, $file);
            return redirect()->back()->with('message', 'Import thành công');
        }
    }

    public function delete($id)
    {
        $pi = PI::find($id);
        $pi->show = 0;
        $pi->save();
        return redirect()->back()->with('message', 'Xóa thông tin nhân viên thành công');
    }
//    public function getdegreedetail($id){
//        $dedeatail = DegreeDetail::find($id);
//        return view('admin.pi.pi-detail',compact('dedeatail'));
//    }
}
