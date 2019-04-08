<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Auth;
use App\PI;
use App\Nation;
use App\Degree;
use App\DegreeDetail;
use App\AcademicRankType;
use App\Specialized;
use Illuminate\Support\Facades\Gate;
use App\Industry;
use App\Unit;
use App\Workload;
use App\WorkloadSession;
use App\Semester;
use App\Country;
use App\ScientificBackground;
use App\AcademicRank;
use Hash;
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
use App\Religion;


class EmployeeController extends Controller
{

    public function getdetail()
    {
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $employee = Employee::findOrFail(Auth::guard('employee')->user()->id);
        $units = Unit::all();
        $provinces = Province::all('name_with_type','code');
        $dh_count = $pi->degreedetails->where('degree_id', 1)->count();
        $ths_count = $pi->degreedetails->where('degree_id', 2)->count();
        $ts_count = $pi->degreedetails->where('degree_id', 3)->count();
        return view('employee.pi.pi-detail', compact('pi','provinces', 'employee', 'dh_count', 'ths_count', 'ts_count'));
    }
    public function getupdate()
    {

        $nations = Nation::all();
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $provinces = Province::all('name_with_type','code');
        $units = Unit::all();
        $officer_types = OfficerType::all();
        $position_types = PositionType::all();
        $teacher_types = TeacherType::all();
        $teacher_titles = TeacherTitle::all();
        $religions = Religion::all();

        return view('employee.pi.pi-update', compact('pi','nations', 'units','provinces','officer_types','position_types','teacher_types','teacher_titles','religions'));
    }
    public function postupdate(Request $request)
    {
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);

        //post data
        $request->validate(
            [
                'full_name'=> 'required|min:4|max:60',
                'nation'=> 'required',
                'date_of_birth'=>'required|date',
                'place_of_birth'=> 'required',
                'permanent_address'=> 'max:100',
                'contact_address'=> 'max:100',
                'phone_number'=> 'required',
                'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
                'identity_card'=> 'required|unique:personalinformations,identity_card,'.$pi->id,
                'date_of_issue' => 'required|date',
                'place_of_issue'=> 'required',
                'province_1'=> 'required',
                'district_1'=> 'required',
                'ward_1'=> 'required',
                'province_2'=> 'required',
                'district_2'=> 'required',
                'ward_2'=> 'required',
                'religion'=> 'required',
            ],
            [

                'full_name.required' =>'Họ và tên không được bỏ trống',
                'full_name.min' =>'Họ và tên phải lớn hơn 4 kí tự',
                'full_name.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
                'nation.required' =>'Dân tộc không được bỏ trống',
                'date_of_birth.required' =>'Ngày sinh không được bỏ trống',
                'date_of_birth.date' =>'Ngày sinh sai định dạng',
                'place_of_birth.required' =>'Nơi sinh không được bỏ trống',
                // 'permanent_address.min' =>'Địa chỉ thường trú phải lớn hơn 6 kí tự',
                'permanent_address.max' =>'Địa chỉ thường trú phải nhỏ hơn 100 kí tự',
                'province_1.required' =>'Tỉnh/Thành phố không được bỏ trống',
                'district_1.required' =>'Quận không được bỏ trống',
                'ward_1.required' =>'Phường/xã không được bỏ trống',
                // 'contact_address.min' =>'Địa chỉ liên hệ phải lớn hơn 6 kí tự',
                'contact_address.max' =>'Địa chỉ liên hệ phải nhỏ hơn 100 kí tự',
                'province_2.required' =>'Tỉnh/Thành phố không được bỏ trống',
                'district_2.required' =>'Quận không được bỏ trống',
                'ward_2.required' =>'Phường/xã không được bỏ trống',

                'phone_number.required' =>'Số điện thoại không được bỏ trống',
                'email_address.required' =>'Email không được bỏ trống',
                'email_address.email' =>'Email sai định dạng',
                'email_address.unique' =>'Email đã được sử dụng',

                'identity_card.unique' =>'Chứng minh nhân dân đã được sử dụng',
                'identity_card.required' =>'Chứng minh nhân dân không được bỏ trống',
                'date_of_issue.required' =>'Ngày cấp không được bỏ trống',
                'date_of_issue.date' =>'Ngày cấp sai định dạng',
                'place_of_issue.required' =>'Nơi cấp không được bỏ trống',
                'religion.required' =>'Tôn giáo không được bỏ trống'
            ]
        );
        //post data


        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation_id= $request->nation;
        $pi->religion_id= $request->religion;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        // $pi->permanent_address= $request->permanent_address;
        // $pi->contact_address= $request->contact_address;
        $pi->home_town= $request->home_town;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        $pi->new = 1 ;
        //validate data
        if($pi->permanent_address()->exists() && $pi->contact_address()->exists()){
            $permanent_address = Address::where('id',$pi->permanent_address_id)->firstOrFail();
            // luu cac thong tin update ve address o day
            $permanent_address->address_content = $request->permanent_address;
            $permanent_address->province_code = $request->province_1;
            $permanent_address->district_code = $request->district_1;
            $permanent_address->ward_code = $request->ward_1;
            $permanent_address->save();
            $pi->permanent_address_id = $permanent_address->id;


            $contact_address = Address::where('id',$pi->contact_address_id)->firstOrFail();
            // luu cac thong tin update ve address o day
            $contact_address->address_content = $request->contact_address;
            $contact_address->province_code = $request->province_2;
            $contact_address->district_code = $request->district_2;
            $contact_address->ward_code = $request->ward_2;
            $contact_address->save();
            $pi->contact_address_id = $contact_address->id;


        }else{
            $permanent_address = new Address;
            // neu nhan vien nao chua co address tu truoc se dc tao moi address
            // luu cac thong tin update ve address o day
            $permanent_address->address_content = $request->permanent_address;
            $permanent_address->province_code = $request->province_1;
            $permanent_address->district_code = $request->district_1;
            $permanent_address->ward_code = $request->ward_1;
            $permanent_address->save();
            $pi->permanent_address_id = $permanent_address->id;



            $contact_address = new Address;
            // luu cac thong tin update ve address o day

            $contact_address->address_content = $request->contact_address;
            $contact_address->province_code = $request->province_2;
            $contact_address->district_code = $request->district_2;
            $contact_address->ward_code = $request->ward_2;
            $contact_address->save();
            $pi->contact_address_id = $contact_address->id;


        }



        $pi->save();


        return redirect()->back()->with('message', 'Cập Nhật thành công');
    }
    public function getcreatedegree()
    {

        $specializes = Specialized::all();
        $degrees = Degree::all();
        $countries = Country::all();
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);

        return view('employee.pi.pi-createdegreedetail', compact('degrees', 'pi','specializes','countries'));
    }
    public function postcreatedegree(Request $request)
    {
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $request->validate(
            [
                'date_of_issue'=> 'required|date',
                'place_of_issue'=> 'required',
                'degree'=> 'required',
                'specialized'=> 'required'
            ],
            [
                'date_of_issue.required' => 'Ngày cấp không được bỏ trống',
                'date_of_issue.date' => 'Ngày cấp không đúng định dạng',
                'degree.required' => 'Bằng cấp không được bỏ trống',
                'place_of_issue.required' => 'Nơi cấp không được bỏ trống',
                'specialized.required' => 'Chuyên ngành không được bỏ trống',
            ]
        );
        $pi->new = 1 ;
        $pi->save();
        $degree_detail = new DegreeDetail;
        $degree_detail->personalinformation_id = $pi->id;
        $degree_detail->date_of_issue = $request->date_of_issue;
        $degree_detail->place_of_issue = $request->place_of_issue;
        $degree_detail->degree_id = $request->degree;
        $degree_detail->industry_id = 8;
        $degree_detail->specialized = $request->specialized;
        $degree_detail->nation_of_issue_id = $request->nation_of_issue_id;
        $degree_detail->degree_type = $request->degree_type;
        $degree_detail->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
    public function getchangepass()
    {
        //$employee = Employee::all();
        $employee = Employee::findOrFail(Auth::guard('employee')->user()->id);
        return view('employee.pi.pi-changepass', compact('employee'));
    }
    public function postchangepass(Request $request)
    {
        $employee = Employee::findOrFail(Auth::guard('employee')->user()->id);
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $request->validate(
            [
                'password'=> 'required',
                'newpassword'=> 'required|min:5|max:50|alpha_num',
                'comfirmpassword'=> 'required|same:newpassword'
            ],
            [
                'password.required' => 'Chưa xác nhận mật khẩu cũ',
                'newpassword.required' => 'Mật khẩu mới không được bỏ trống',
                'newpassword.min' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự',
                'newpassword.max' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự',
                'newpassword.alpha_num' => 'Mật khẩu mới chỉ được chứa kí tự và số',
                'comfirmpassword.required' => 'Xác nhận mật khẩu mới không được bỏ trống',
                'comfirmpassword.same' =>'Xác nhận mật khẩu mới không chính xác',

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
    //get degree
    public function getdegreelist()
    {

        $pi = Auth::guard('employee')->user()->pi;

        $degrees = DegreeDetail::where('personalinformation_id',$pi->id)->get();


        $degree = Degree::where('id');
        $industries = Industry::all();
        //$degreede = DegreeDetail::all();


        return view('employee.pi.pi-degree-list', compact('degrees', 'industries','pi'));
    }
    public function getupdatedegreedetail($b)
    {
        $degree = DegreeDetail::findOrFail($b);
        $employee = Auth::guard('employee')->user();
        if($this->checkIsOwnerCanUpdate($employee,$degree)){
            $pi = Auth::guard('employee')->user()->pi;
            $specializes = Specialized::all();
            $degrees = Degree::all();
            $countries = Country::all();
            return view('employee.pi.pi-updatedetaildegree', compact('degrees','degree','pi','specializes','countries'));
        }

    }
    public function postupdatedegreedetail(Request $request,$b)
    {
        $degree = DegreeDetail::findOrFail($b);
        $employee = Auth::guard('employee')->user();
        if($this->checkIsOwnerCanUpdate($employee,$degree)){
            $request->validate(
                [
                    'date_of_issue'=> 'required|date',
                    'place_of_issue'=> 'required',
                    'degree'=> 'required',
                    'specialized'=> 'required'
                ],
                [
                    'date_of_issue.required' => 'Ngày cấp không được bỏ trống',
                    'date_of_issue.date' => 'Ngày cấp không đúng định dạng',
                    'degree.required' => 'Bằng cấp không được bỏ trống',
                    'place_of_issue.required' => 'Nơi cấp không được bỏ trống',
                    'specialized.required' => 'Chuyên ngành không được bỏ trống',
                ]
            );
            $pi = Auth::guard('employee')->user()->pi;
            $pi->new = 1 ;
            $pi->save();
            $degree->date_of_issue = $request->date_of_issue;
            $degree->place_of_issue = $request->place_of_issue;
            $degree->degree_id = $request->degree;
            $degree->industry_id = 8;
            $degree->specialized = $request->specialized;
            $degree->nation_of_issue_id = $request->nation_of_issue_id;
            $degree->degree_type = $request->degree_type;
            $degree->save();
            return redirect()->back()->with('message', 'Cập nhật thành công');
        }

    }
    public function delete($degreedetail_id){

        $degree = DegreeDetail::findOrFail($degreedetail_id);
        $employee = Auth::guard('employee')->user();
        if($this->checkIsOwnerCanUpdate($employee,$degree)){
            $degree = DegreeDetail::findOrFail($degreedetail_id);
            $degree->delete();
            return redirect()->back()->with('message', 'Xóa thành công');
        }
    }

    public function checkIsOwnerCanUpdate($current_user,$degree_detail){
        if ($current_user->can('update', $degree_detail)) {
            return true;
        } else {
            return abort('403','Bạn không có quyền thực hiện thao tác này');
        }
    }
    public function getFaculty()
    {
        $this->authorize('actAsFacultyLeader', PI::firstOrFail());
        $current_user_pi = Auth::guard('employee')->user()->pi;

        // $pis = PI::all();


        //check if have any get request named 'search' then assign value to $search
        $search =  \Request::get('search');
        //query if $search have a value
        $pis = PI::where('unit_id',$current_user_pi->unit_id)->where(function ($query) use ($search) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->where('employee_code', 'like', '%'.$search.'%')
                      ->orWhere('full_name', 'like', '%'.$search.'%')
                      ->orWhere('identity_card', 'like', '%'.$search.'%');
                });
            }
        })->orderBy('first_name', 'asc')->paginate(10)->appends(['search'=>$search]);


        return view('employee.faculty.fa-pi-list', compact('pis','search'));
    }
    public function getFacultydetail($id)
    {
        $pi = PI::findOrFail($id);
        $this->authorize('actAsFacultyLeader', $pi);

        $dh_count = $pi->degreedetails->where('degree_id', 1)->count();
        $ths_count = $pi->degreedetails->where('degree_id', 2)->count();
        $ts_count = $pi->degreedetails->where('degree_id', 3)->count();


        return view('employee.faculty.fa-pi-detail', compact('pi', 'dh_count', 'ths_count', 'ts_count'));
    }
    public function getfaWorkload($id)
    {
        $pi = PI::findOrFail($id);
        $this->authorize('actAsFacultyLeader', $pi);

        $workloads_own_user = Workload::where('personalinformation_id', $id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $semester = Semester::all();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->firstOrFail();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $workload_session_current_id = $workload_session_current->id;
        $search =  \Request::get('search');
        $semester_filter = \Request::get('semester');

        //query if $search have a value
        $workloads = $workloads_own_user->where(function ($query) use ($search,$year_workload,$workload_session_current_id,$semester_filter) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->where('subject_code', 'like', '%'.$search.'%')
                        ->orWhere('subject_name', 'like', '%'.$search.'%')
                        ->orWhere(function ($q2) use ($search) {
                            $q2->whereHas('unit', function ($q3) use ($search) {
                                $q3->where('name', 'like', '%'.$search.'%')
                                    ->orWhere('unit_code', 'like', '%'.$search.'%');
                            });
                        });
                });
            }
            if ($semester_filter != null) {
                if ($semester_filter !=4) {
                    $query->whereHas('semester', function ($q) use ($semester_filter) {
                        $q->where('alias', $semester_filter);
                    });
                }
            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            } elseif ($search ==null && $year_workload==null && $semester_filter ==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'desc')->get();

        return view('employee.faculty.fa-workload-detail', compact('pi','semester_filter', 'semester', 'workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload', 'pi'));
    }
    public function getfacultysb($id)
    {

        $pi = PI::findOrFail($id);
        $this->authorize('actAsFacultyLeader', $pi);

        $sb = ScientificBackground::where('personalinformation_id', $pi->id)->firstOrFail();
        return view('employee.faculty.fa-sb-detail', compact('id', 'sb','pi'));
    }
    public function getfacultydegreelist($id){
        $pi = PI::findOrFail($id);
        $this->authorize('actAsFacultyLeader', $pi);
        $degrees = DegreeDetail::where('personalinformation_id',$pi->id)->get();


        $degree = Degree::where('id');
        $industries = Industry::all();



        return view('employee.faculty.fa-degree-list', compact('degrees', 'industries','pi'));

        $sb = ScientificBackground::where('personalinformation_id', $pi->id)->firstOrFail();
        return view('employee.faculty.degree.list', compact('id', 'sb','pi'));
    }
    public function getCreateAcademicRank(){
        $academic_rank_types = AcademicRankType::all();
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        return view('employee.pi.academic-create',compact('pi','academic_rank_types'));

    }
    public function postCreateAcademicRank(Request $request){
        $this->validate($request,
            [
                'academic_rank_type' => 'required',
                'specialized' => 'required',
                'date_of_recognition' => 'date|required',
            ],
            [
                'academic_rank_type.required' => 'Vui lòng chọn học hàm',
                'specialized.required' => 'Vui lòng nhập chuyên ngành',
                'date_of_recognition.required' => 'Vui lòng nhập ngày công nhận',
                'date_of_recognition.date' => 'Ngày công nhận không hợp lệ',
            ]
        );
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $academic_rank = new AcademicRank;
        $academic_rank->personalinformation_id = $pi->id;
        $academic_rank->type_id = $request->academic_rank_type;
        $academic_rank->specialized = $request->specialized;
        $academic_rank->date_of_recognition = $request->date_of_recognition;
        $academic_rank->save();
        return redirect()->route('employee.pi.detail')->with('message','Thêm mới thành công');
    }

    public function getUpdateAcademicRank(){

        $academic_rank_types = AcademicRankType::all();
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        return view('employee.pi.academic-update',compact('pi','academic_rank_types'));

    }

    public function postUpdateAcademicRank(Request $request){
        $this->validate($request,
            [
                'academic_rank_type' => 'required',
                'specialized' => 'required',
                'date_of_recognition' => 'date|required',
            ],
            [
                'academic_rank_type.required' => 'Vui lòng chọn học hàm',
                'specialized.required' => 'Vui lòng nhập chuyên ngành',
                'date_of_recognition.required' => 'Vui lòng nhập ngày công nhận',
                'date_of_recognition.date' => 'Ngày công nhận không hợp lệ',
            ]
        );
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $academic_rank = AcademicRank::where('personalinformation_id',$pi->id)->firstOrFail();
        $academic_rank->type_id = $request->academic_rank_type;
        $academic_rank->specialized = $request->specialized;
        $academic_rank->date_of_recognition = $request->date_of_recognition;
        $academic_rank->save();
        return redirect()->back()->with('message','Cập nhật thành công');
    }


    public function getDeleteAcademicRank(){
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $academic_rank = AcademicRank::where('personalinformation_id',$pi->id)->firstOrFail();
        $academic_rank->delete();
        return redirect()->back()->with('message','Xóa học hàm thành công');
    }
}
