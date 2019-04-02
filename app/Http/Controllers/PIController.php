<?php

namespace App\Http\Controllers;

use App\DegreeDetail;
use App\Industry;
use Illuminate\Http\Request;
use App\PI;
use App\ScientificBackground;
use App\Imports\AdminPIImport;
use App\Imports\GetPIImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Hash;
use App\Workload;
use App\WorkloadSession;
use App\AcademicRankType;
use App\AcademicRank;
use App\Admin;
use App\Nation;
use App\Unit;
use App\Ward;
use App\District;
use App\Province;
use App\Address;
use App\OfficerType;
use App\Officer;
use App\PositionType;
use App\TeacherTitle;
use App\TeacherType;
use App\Teacher;

class PIController extends Controller
{
    public function downloadtemplate()
    {
        $file = public_path('template-personalinformation.xlsx');
        $headers = array(
        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      );
        return response()->download($file, 'Template Personal Information.xlsx', $headers);
    }
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
        $this->authorize('cud', PI::first());
        $nations = Nation::all();
        $units = Unit::all();
        $officer_types = OfficerType::all();
        $position_types = PositionType::all();
        $teacher_types = TeacherType::all();
        $teacher_titles = TeacherTitle::all();
        // $wards = Ward::all('name_with_type','code');
        $provinces = Province::all('name_with_type','code');
        return view('admin.pi.pi-add', compact('nations', 'units','provinces','officer_types','position_types','teacher_types','teacher_titles'));
    }

    public function getDistricts(){
        $province_code = Input::get('province_code');
        $districts = District::where('parent_code',$province_code)->get(['name_with_type','code']);
        return response()->json($districts);
    }
    public function getWards(){
        $district_code = Input::get('district_code');
        $wards = Ward::where('parent_code',$district_code)->get(['name_with_type','code']);
        return response()->json($wards);
    }

    public function postAdd(Request $request)
    {
        $this->authorize('cud', PI::first());
        $request->validate(
          [
            'employee_code'=> 'required|unique:personalinformations,employee_code',
            'full_name'=> 'required|min:4|max:60',
            'nation'=> 'required',
            'date_of_birth'=>'required|date',
            'place_of_birth'=> 'required',
            'permanent_address'=> 'required|min:6|max:100',
            'province_1'=> 'required',
            'district_1'=> 'required',
            'ward_1'=> 'required',
            'contact_address'=> 'required|min:6|max:100',
            'province_2'=> 'required',
            'district_2'=> 'required',
            'ward_2'=> 'required',
            'phone_number'=> 'required',
            'email_address'=> 'required|email|unique:personalinformations,email_address',
            'position'=> 'required',
            'date_of_recruitment' => 'required|date',
            'professional_title'=> 'required',
            'identity_card'=> 'required|unique:personalinformations,identity_card',
            'date_of_issue' => 'required|date',
            'place_of_issue'=> 'required',
            'unit'=> 'required',
            'position_type'=> 'required',
            'officer_type'=> 'required',
            'teacher_type'=> 'required',
            'teacher_title'=> 'required',
            'is_retired'=> 'required',
            'date_of_retirement'=> 'required',
            'is_concurrently'=> 'required',
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
            'place_of_birth.required' =>'Nơi sinh không được bỏ trống',
            'permanent_address.min' =>'Địa chỉ thường trú phải lớn hơn 6 kí tự',
            'permanent_address.max' =>'Địa chỉ thường trú phải nhỏ hơn 100 kí tự',
            'permanent_address.required' =>'Địa chỉ thường trú không được bỏ trống',
            'province_1.required' =>'Tỉnh/Thành phố không được bỏ trống',
            'district_1.required' =>'Quận không được bỏ trống',
            'ward_1.required' =>'Phường/xã không được bỏ trống',
            'contact_address.min' =>'Địa chỉ liên hệ phải lớn hơn 6 kí tự',
            'contact_address.max' =>'Địa chỉ liên hệ phải nhỏ hơn 100 kí tự',
            'contact_address.required' =>'Địa chỉ liên hệ không được bỏ trống',
            'province_2.required' =>'Tỉnh/Thành phố không được bỏ trống',
            'district_2.required' =>'Quận không được bỏ trống',
            'ward_2.required' =>'Phường/xã không được bỏ trống',
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
            'place_of_issue.required' =>'Nơi cấp không được bỏ trống',
            'unit.required' =>'Đơn vị không được bỏ trống',
            'teacher_type.required' =>'Loại giảng viên không được bỏ trống',
            'teacher_title.required' =>'Chức danh nghề nghiệp không được bỏ trống',
            'is_retired.required' =>'Nghỉ hưu không được bỏ trống',
            'date_of_retirement.required' =>'Ngày nghỉ hưu không được bỏ trống',
            'officer_type.required' =>'Loại cán bộ không được bỏ trống',
            'position_type.required' =>'Chức vụ không được bỏ trống',
            'is_concurrently.required' =>'Kiêm nhiệm giảng dạy không được bỏ trống',
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
        $pi->nation_id= $request->nation;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        // $pi->permanent_address_id= $request->permanent_address;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->position= $request->position;
        $pi->date_of_recruitment= $request->date_of_recruitment;
        $pi->professional_title= $request->professional_title;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        $pi->show = 1;
        $pi->new = 0;
        $pi->unit_id = $request->unit;

        $permanent_address = new Address;
        $permanent_address->address_content = $request->permanent_address;
        $permanent_address->province_code = $request->province_1;
        $permanent_address->district_code = $request->district_1;
        $permanent_address->ward_code = $request->ward_1;
        $permanent_address->save();
        $pi->permanent_address_id = $permanent_address->id;

        $contact_address = new Address;
        $contact_address->address_content = $request->$contact_address;
        $contact_address->province_code = $request->province_2;
        $contact_address->district_code = $request->district_2;
        $contact_address->ward_code = $request->ward_2;
        $contact_address->save();
        $pi->contact_address_id = $contact_address->id;
        $pi->save();


        //check is Admin ?
        //add acoount for employee role
        $employee = new Employee;
        $employee->personalinformation_id = $pi->id;
        $employee->username= $pi->employee_code;
        $employee->password = Hash::make($pi->employee_code);
        $employee->email = $pi->email_address;
        $employee->is_leader = 0 ;
        $employee->save();


        ScientificBackground::updateOrCreate(
            [
                'personalinformation_id' => $pi->id,
            ],
            [
                'personalinformation_id' => $pi->id,
                'highest_scientific_title' => 'Chưa có',
                'year_of_appointment' => '',
                'address' => $pi->contact_address,
                'highest_degree' =>'Chưa có',
                'orga_phone_number' => 'Chưa có',
                'home_phone_number' => 'Chưa có',
                'mobile_phone_number' => $pi->phone_number
            ]
        );


        $officer = new Officer;
        $officer->personalinformation_id = $pi->id;
        $officer->type_id = $request->officer_type;
        $officer->position_id = $request->position_type;
        $officer->is_concurrently = $request->is_concurrently;
        $officer->save();

        $teacher = new Teacher;
        $teacher->personalinformation_id = $pi->id;
        $teacher->type_id = $request->teacher_type;
        $teacher->title_id = $request->teacher_title;
        $teacher->is_retired = $request->is_retired; //đã nghĩ hưu chưa ( radio button)
        $teacher->date_of_retirement = $request->date_of_retirement; // ngày nghĩ hưu người dùng nhập bên view
        if ($request->has('is_excellent_teacher')){
          $teacher->is_excellent_teacher = 1; //Nhà giáo ưu tú
        }
        if($request->has('is_excellent_teacher')){
          //Nhà giáo nhân dân | 2 thang cuối này là cái checkbox chọn cái nào thì cái đó = 1
          $teacher->is_national_teacher = 1;
        }
        $teacher->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
    //get data personal information
    public function getupdate($id)
    {
        $this->authorize('cud', PI::first());
        $pi = PI::Find($id);
        $nations = Nation::all();
        $units = Unit::all();
        $officer_types = OfficerType::all();
        $position_types = PositionType::all();
        $teacher_types = TeacherType::all();
        $teacher_titles = TeacherTitle::all();

        $provinces = Province::all('name_with_type','code');
        return view('admin.pi.pi-update', compact('pi', 'nations', 'units', 'provinces','officer_types','position_types','teacher_types','teacher_titles'));
    }
    //post date update information
    public function postupdate(Request $request, $id)
    {

        //post data
        $pi = PI::Find($id);
        $this->authorize('cud', $pi);
        $request->validate(
          [
              'full_name'=> 'required|min:4|max:60',
              'nation'=> 'required',
              'date_of_birth'=>'required|date',
              'place_of_birth'=> 'required',
              'permanent_address'=> 'required|min:6|max:100',
              'contact_address'=> 'required|min:6|max:100',
              'phone_number'=> 'required',
              'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
              'position'=> 'required',
              'date_of_recruitment' => 'required|date',
              'professional_title'=> 'required',
              'identity_card'=> 'required|unique:personalinformations,identity_card,'.$pi->id,
              'date_of_issue' => 'required|date',
              'place_of_issue'=> 'required',
              'unit' => 'required'
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
              'place_of_issue.required' =>'Nơi cấp không được bỏ trống',
              'unit.required' =>'Đơn vị không được bỏ trống',
          ]
        );
        //post data
        $pi->id= $request->id;
        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation_id= $request->nation;
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
        $pi->unit_id = $request->unit;

        $pi->save();



        return redirect()->back()->with('message', 'Cập Nhật thành công');
    }
    public function getdetail($id)
    {
        $pi = PI::find($id);
        $pi->new = 0;
        $pi->save();
        $dh_count = $pi->degreedetails->where('degree_id', 1)->count();
        $ths_count = $pi->degreedetails->where('degree_id', 2)->count();
        $ts_count = $pi->degreedetails->where('degree_id', 3)->count();


        return view('admin.pi.pi-detail', compact('pi', 'dh_count', 'ths_count', 'ts_count'));
    }

    public function recoverypassword($pi_id)
    {
        $pi = PI::find($pi_id);
        $this->authorize('cud', $pi);
        //strtoupper cho nó in hoa khi gõ pass
        //chỉ cần thay đổi trường pwd la dc
        if ($pi->admin != '') {
            $pi->employee->password = Hash::make(strtoupper($pi->employee_code));
            $pi->admin->password = Hash::make(strtoupper($pi->employee_code));
            $pi->employee->save();
            $pi->admin->save();
        } else {
            $pi->employee->password = Hash::make(strtoupper($pi->employee_code));
            $pi->employee->save();
        }

        return redirect()->back()->with('message', 'Khôi phục mật khẩu thành công');
    }

    public function import(Request $request)
    {
        $this->authorize('cud', PI::first());

        $request->validate(
        [
          'import_file' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|file'
        ],
        [
          'import_file.required'=> 'Vui lòng chọn file để import.',
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

    public function delete($pi_id)
    {
        $this->authorize('cud', PI::first());

        $pi = PI::find($pi_id);
        $pi->show = 0;
        $pi->save();
        return redirect()->back()->with('message', 'Xóa thông tin nhân viên thành công');
    }
//    public function getdegreedetail($id){
//        $dedeatail = DegreeDetail::find($id);
//        return view('admin.pi.pi-detail',compact('dedeatail'));
//    }

    public function rolechange(Request $request, $pi_id)
    {
        $pi = PI::find($pi_id);
        $this->authorize('cud', $pi);
        if ($request->role == 0) {
            //check if is admin
            if ($pi->admin !='') {
                $admin = $pi->admin;
                $admin->delete();
                return redirect()->back()->with('message', 'Thay đổi vai trò tài khoản thành công');
            } elseif ($pi->admin =='') {
                if($request->role_employee == 0){
                    $pi->employee->is_leader = 0;
                    $pi->employee->save();
                }else {
                    $pi->employee->is_leader = 1;
                    $pi->employee->save();
                }
                return redirect()->back()->with('message', 'Thay đổi vai trò tài khoản thành công');
            }
        } elseif ($request->role == 1) {
            //check if isn't admin
            if ($pi->admin =='') {
                $admin = new Admin;
                $admin->username = $pi->employee_code;
                $admin->password = Hash::make($pi->employee_code);
                $admin->email = $pi->email_address;
                $admin->personalinformation_id = $pi->id;
                if($request->role_admin == 0 ){
                    $admin->is_supervisor = 1;
                }else{
                    $admin->is_supervisor = 0;
                }
                $admin->save();
                return redirect()->back()->with('message', 'Thay đổi vai trò tài khoản thành công');
            }
            //check if is admin
            elseif ($pi->admin !='') {
                if($request->role_admin == 0 ){
                    $pi->admin->is_supervisor = 1;
                    $pi->admin->save();
                }else{
                    $pi->admin->is_supervisor = 0;
                    $pi->admin->save();
                }
                return redirect()->back()->with('message', 'Thay đổi vai trò tài khoản thành công');
            }
        }
    }
    public function getdataimport(Request $request)
    {
        // $this->authorize('cud', PI::first());
        // dd('a');
        $validator = Validator::make(
          $request->all(),
        [
          'import_file' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|file'
        ],
        [
          'import_file.required'=> 'Vui lòng chọn file để import.',
          'import_file.mimetypes'=> 'File tải lên không đúng định dạng excel (xls,xlsx).',
          'import_file.file'=> 'Không tìm thấy file tải lên.',
        ]
      );
        if ($validator->passes()) {
            if ($request->has('import_file')) {
                $import_file = $request->file('import_file');
                $arr_pi  = (new GetPIImport)->toArray($import_file);
                $number_of_sheet = 3;
                $excel_column_length_sheet_1 = 25;
                $excel_column_length_sheet_2 = 8;
                $excel_column_length_sheet_3 = 5;
                if (count($arr_pi) == $number_of_sheet) {
                    if (count($arr_pi[0][0]) == $excel_column_length_sheet_1) {
                        if (count($arr_pi[1][0]) == $excel_column_length_sheet_2) {
                            if (count($arr_pi[2][0]) == $excel_column_length_sheet_3) {
                                //handle date time from excel to array for sheet 1
                                foreach ($arr_pi[0] as $key => $value) {
                                    if ($key != 0) {
                                        $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[4]);
                                        $date_of_issue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[8]);
                                        $date_of_recruitment = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[12]);
                                        if($value[20] == 'x'){
                                            if($value[21] != null){
                                                $date_of_retirement = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[21]);
                                                $arr_pi[0][$key][21] = $date_of_retirement->format('d-m-Y');
                                            }else{
                                                $date_of_retirement = null;
                                            }
                                        }else{
                                            $date_of_retirement = null;
                                        }

                                        $arr_pi[0][$key][4] = $date_of_birth->format('d-m-Y');
                                        $arr_pi[0][$key][8] = $date_of_issue->format('d-m-Y');
                                        $arr_pi[0][$key][12] = $date_of_recruitment->format('d-m-Y');


                                    }
                                }
                                //handle date time from excel to array for sheet 2
                                foreach ($arr_pi[1] as $key => $value) {
                                    if ($key != 0) {
                                        $date_of_issue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[3]);
                                        $arr_pi[1][$key][3] = $date_of_issue->format('d-m-Y');
                                    }
                                }
                                //handle date time from excel to array for sheet 3
                                foreach ($arr_pi[2] as $key => $value) {
                                    if ($key != 0) {
                                        $date_of_issue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[3]);
                                        $arr_pi[2][$key][3] = $date_of_issue->format('d-m-Y');
                                    }
                                }
                                return response()->json($arr_pi);
                            } else {
                                return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc (Sheet 3) .Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.pi.template.download').'"> (tải file mẫu)</a></small>']]);

                            }
                        } else {
                            return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc (Sheet 2) .Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.pi.template.download').'"> (tải file mẫu)</a></small>']]);
                        }
                    } else {
                        return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc (Sheet 1) .Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.pi.template.download').'"> (tải file mẫu)</a></small>']]);
                    }
                } else {
                    return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc .Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.pi.template.download').'"> (tải file mẫu)</a></small>']]);
                }
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function getCreateAcademicRank($pi_id){
        $industries = Industry::all();
        $academic_rank_types = AcademicRankType::all();
        $pi = PI::find($pi_id);
        return view('admin.pi.academic-create',compact('pi','academic_rank_types','industries'));

    }
    public function postCreateAcademicRank($pi_id,Request $request){
        $this->validate($request,
            [
                'academic_rank_type' => 'required',
                'specialized' => 'required',
                'date_of_recognition' => 'date|required',
                'industry' => 'required',
            ],
            [
                'academic_rank_type.required' => 'Vui lòng chọn học hàm',
                'specialized.required' => 'Vui lòng nhập chuyên ngành',
                'date_of_recognition.required' => 'Vui lòng nhập ngày công nhận',
                'date_of_recognition.date' => 'Ngày công nhận không hợp lệ',
                'industry.required' => 'Vui lòng chọn khối ngành',
            ]
        );
        $pi = PI::find($pi_id);
        $academic_rank = new AcademicRank;
        $academic_rank->personalinformation_id = $pi->id;
        $academic_rank->type_id = $request->academic_rank_type;
        $academic_rank->specialized = $request->specialized;
        $academic_rank->date_of_recognition = $request->date_of_recognition;
        $academic_rank->industry_id = $request->industry;
        $academic_rank->save();
        return redirect()->route('admin.pi.detail',$pi->id)->with('message','Thêm mới thành công');
    }

    public function getUpdateAcademicRank($pi_id){
        $industries = Industry::all();
        $pi = PI::find($pi_id);
        $academic_rank_types = AcademicRankType::all();
        return view('admin.pi.academic-update',compact('pi','academic_rank_types','industries'));

    }

    public function postUpdateAcademicRank($pi_id,Request $request){
        $this->validate($request,
            [
                'academic_rank_type' => 'required',
                'specialized' => 'required',
                'date_of_recognition' => 'date|required',
                'industry' => 'required',
            ],
            [
                'academic_rank_type.required' => 'Vui lòng chọn học hàm',
                'specialized.required' => 'Vui lòng nhập chuyên ngành',
                'date_of_recognition.required' => 'Vui lòng nhập ngày công nhận',
                'date_of_recognition.date' => 'Ngày công nhận không hợp lệ',
                'industry.required' => 'Vui lòng chọn khối ngành',
            ]
        );
        $pi = PI::find($pi_id);
        $academic_rank = AcademicRank::where('personalinformation_id',$pi->id)->first();
        $academic_rank->type_id = $request->academic_rank_type;
        $academic_rank->specialized = $request->specialized;
        $academic_rank->date_of_recognition = $request->date_of_recognition;
        $academic_rank->industry_id = $request->industry;
        $academic_rank->save();
        return redirect()->back()->with('message','Cập nhật thành công');
    }
}
