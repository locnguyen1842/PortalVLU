<?php

namespace App\Http\Controllers;

use App\PI;
use App\Unit;
use Maatwebsite\Excel\Facades\Excel;
use App\Workload;
use App\WorkloadSession;
use Validator;
use App\Employee;
use App\Semester;
use Auth;
use App\Imports\WorkloadImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkloadController extends Controller
{
    public function index()
    {
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->first();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $search =  \Request::get('search');
        $workload_session_current_id = $workload_session_current->id;
        //query if $search have a value
        $workloads = Workload::where(function ($query) use ($search,$year_workload,$workload_session_current_id) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('pi', function ($q1) use ($search) {
                        $q1->where('employee_code', 'like', '%'.$search.'%');
                    })
                        ->orWhere(function ($q2) use ($search) {
                            $q2->whereHas('unit', function ($q3) use ($search) {
                                $q3->where('name', 'like', '%'.$search.'%')
                                    ->orWhere('unit_code', 'like', '%'.$search.'%');
                            });
                        })
                        ->orWhere('subject_code', 'like', '%'.$search.'%')
                        ->orWhere('subject_name', 'like', '%'.$search.'%');
                });
            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            } elseif ($search ==null && $year_workload==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.workload.workload-list', compact('workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));
    }
    public function getlistworkloadbypi($pi_id)
    {
        //workload of own detail
        $workloads_own_user = Workload::where('personalinformation_id', $pi_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $semester = Semester::all();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->first();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $workload_session_current_id = $workload_session_current->id;
        $search =  \Request::get('search');
        $semester_filter = \Request::get('semester');

        //query if $search have a value
        $workloads = $workloads_own_user->where(function ($query) use ($semester_filter,$search,$year_workload,$workload_session_current_id) {
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
            } elseif ($search ==null && $year_workload==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.pi.pi-workload-list', compact('semester_filter', 'semester', 'pi_id', 'workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));
    }
    //get
    public function getadd()
    {
        $workload = Workload::all();
        $id = \Request::get('pi_id');
        $data_append = \Request::get('data_html');
        $se = Semester::all();
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        $unit = Unit::all();

        if ($id != null) {
            $pi = PI::find($id);
        } else {
            $pi = null;
        }


        if ($data_append !=null) {
            return json_encode($data_append);
            // return view('admin.workload.workload-add', compact('workload', 'pi', 'ws', 'se', 'unit','data_append'));
        }

        return view('admin.workload.workload-add', compact('workload', 'pi', 'ws', 'se', 'unit'));
    }
    //post workload
    public function postadd(Request $request)
    {
        $value_start_year = \Request::get('start_year');
        $validator=Validator::make($request->all(),
            [
                'employee_code'=> 'required|min:4|max:60',
                'session_id'=> 'required_if:session_new,==,0',
                'session_new'=> 'required',
                'start_year'=> 'required_if:session_new,==,1|integer|nullable|unique:workloadsessions,start_year',
                'end_year'=>    [
                                    'required_if:session_new,==,1',
                                    'integer',
                                    'nullable',
                                    function ($attribute, $value, $fail) use ($value_start_year) {
                                        if ($value - $value_start_year != 1) {
                                            $fail('Năm kết thúc chỉ được lớn hơn năm bắt đầu 1 năm');
                                        }
                                    }
                                ],

                'subject_code.*'=>'required|string|alpha_num',
                'subject_name.*'=> 'required|string',
                'number_of_lessons.*'=> 'required|integer',
                'number_of_students.*'=> 'required|integer',
                'class_code.*'=> 'required|string',
                'total_workload.*'=> 'required|numeric',
                'theoretical_hours.*'=> 'required|numeric',
                'semester.*' => 'required',
                'practice_hours.*'=> 'required|numeric',
                'unit_id' => 'required'
            ],
            [
                'employee_code.required'=> 'Mã giảng viên không được bỏ trống',
                'session_id.required_if' =>'Năm học không được bỏ trống',
                'session_new.required' =>'Năm học không được bỏ trống',
                'start_year.required_if' =>'Năm học bắt đầu không được bỏ trống',
                'end_year.required_if' =>'Năm học kết thúc không được bỏ trống',
                'start_year.integer' =>'Năm học phải là số nguyên',
                'start_year.unique' =>'Năm học đã tồn tại trong danh sách',
                'end_year.integer' =>'Năm học phải là số nguyên',
                'number_of_lessons.*.integer' =>'Số tiết học phải là số nguyên',
                'number_of_students.*.integer' =>'Số sinh viên phải là số nguyên',
                'total_workload.*.numeric' =>'Tổng khối lượng công việc phải là số',
                'practice_hours.*.numeric' =>'Số giờ thực hành phải là số',
                'theoretical_hours.*.numeric' =>'Số giờ lý thuyết phải là số',
                'employee_code.min' =>'Họ và tên phải lớn hơn 4 kí tự',
                'employee_code.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
                'subject_code.*.required' =>'Mã môn học không được bỏ trống',
                'subject_code.*.string' =>'Mã môn học phải là ký tự',
                'subject_code.*.alpha_num' =>'Mã môn học không có ký tự đặc biệt',
                'subject_name.*.string' =>'Tên môn học phải là ký tự',
                'class_code.*.string' =>'Mã lớp học phải là ký tự',
                'subject_name.*.required' =>'Tên môn học không được bỏ trống',
                'number_of_lessons.*.required' =>'Số tiết học không được bỏ trống',
                'number_of_students.*.required' =>'Số sinh viên không được bỏ trống',
                'class_code.*.required' =>'Mã lớp học không được bỏ trống',
                'total_workload.*.required' =>'Tổng khối lượng công việc không được bỏ trống',
                'theoretical_hours.*.required' =>'Số giờ lý thuyết không được bỏ trống',
                'semester.*.required' =>'Học kỳ không được bỏ trống',
                'practice_hours.*.required' =>'Số giờ thực hành không được bỏ trống',
                'unit.*.required' =>'Đơn vị không được bỏ trống',
            ]
        );
        if($validator->passes()){
            //get id employee

            $pp = strtoupper($request->employee_code);
            $pi = PI::where('employee_code', $pp)->first();
            //add data

            //
            for ($i = 0 ; $i< count($request->subject_code);$i++) {
                //dynamic data
                $workload = new Workload();
                $workload->personalinformation_id = $pi->id;
                $workload->unit_id= $pi->unit->id;
                if ($request->session_new == 0) {
                    $workload->session_id= $request->session_id;
                } else {
                    $workload_session = new WorkloadSession();
                    $workload_session->start_year = $request->start_year;
                    $workload_session->end_year = $request->end_year;
                    $workload_session->save();
                    $workload->session_id = $workload_session->id;
                }

                //array data
                $workload->subject_code= strtoupper(($request->subject_code)[$i]);
                $workload->subject_name= ($request->subject_name)[$i];
                $workload->number_of_lessons= ($request->number_of_lessons)[$i];
                $workload->class_code= ($request->class_code)[$i];
                $workload->number_of_students= ($request->number_of_students)[$i];
                $workload->total_workload= ($request->total_workload)[$i];
                $workload->theoretical_hours= ($request->theoretical_hours)[$i];
                $workload->practice_hours= ($request->practice_hours)[$i];

                $workload->note= ($request->note)[$i];
                $workload->semester_id= ($request->semester)[$i];
                $workload->save();
            }
            return redirect()->back()->with('message', 'Thêm thành công');
        }else{

            return redirect()->route('admin.workload.add',['pi_id' => 4])->withErrors($validator)->withInput();
        }

    }
    //
    public function getUpdateWorkload($workload_id)
    {
        $se = Semester::all();
        $workload = Workload::find($workload_id);
        $pi = PI::find($workload->pi->id);
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        $unit = Unit::all();

        return view('admin.workload.workload-update', compact('workload', 'pi', 'ws', 'se', 'unit'));
    }

    public function postUpdateWorkload(Request $request, $workload_id)
    {
        $value_start_year = \Request::get('start_year');
        $request->validate(
        [
          'subject_code'=> 'required|alpha_num',
          'subject_name'=> 'required',
          'number_of_lessons'=> 'required|integer',
          'class_code'=>'required',
          'number_of_students'=> 'required|integer',
          'total_workload'=> 'required|numeric',
          'theoretical_hours'=> 'required|numeric',
          'practice_hours'=> 'required|numeric',
          'unit_id'=> 'required',
          'semester' => 'required',
          'session_id' => 'required_if:session_new,==,0',
          'start_year' => 'required_if:session_new,==,1|nullable|unique:workloadsessions,start_year',

          'end_year' => [
            'required_if:session_new,==,1',
            'gt:start_year',
            'nullable',
                                    function ($attribute, $value, $fail) use ($value_start_year) {
                                        if ($value - $value_start_year != 1) {
                                            $fail('Năm kết thúc chỉ được lớn hơn năm bắt đầu 1 năm.');
                                        }
                                    }
            ],
        ],
        [
          'subject_code.required'=> 'Mã môn học không được bỏ trống',
          'subject_code.alpha_num'=> 'Mã môn học không có tự đặc biệt',
          'subject_name.required'=> 'Tên môn học không được bỏ trống',
          'number_of_lessons.required'=> 'Số tiết học không được bỏ trống',
          'number_of_lessons.integer'=> 'Số tiết học sai định dạng',
          'class_code.required'=> 'Mã lớp học không được bỏ trống',
          'number_of_students.required'=> 'Số sinh viên không được bỏ trống',
          'number_of_students.integer'=> 'Số sinh viên sai định dạng',
          'total_workload.required'=> 'Tổng số giờ không được bỏ trống',
          'total_workload.numeric'=> 'Tổng số giờ sai định dạng',
          'theoretical_hours.required'=> 'Giờ lý thuyết không được bỏ trống',
          'theoretical_hours.numeric'=> 'Giờ lý thuyết không đúng định dạng',
          'practice_hours.required'=> 'Giờ thực hành không được bỏ trống',
          'practice_hours.numeric'=> 'Giờ thực hành không đúng định dạng',
          'unit.required'=> 'Đơn vị không được bỏ trống',
          'semester.required'=> 'Học kì không được bỏ trống',
          'session_id.required'=> 'Năm học không được bỏ trống',
          'start_year.required_if'=> 'Năm học bắt đầu không được bỏ trống',
          'start_year.unique'=> 'Năm học đã tồn tại trong danh sách',
          'end_year.required_if'=> 'Năm học kết thúc không được bỏ trống',
          'end_year.gt'=> 'Năm học kết thúc phải lớn hơn năm bắt đầu',

        ]
    );

        $workload = Workload::find($workload_id);
        $workload->subject_code= mb_strtoupper($request->subject_code);
        $workload->subject_name= $request->subject_name;
        $workload->number_of_lessons= $request->number_of_lessons;
        $workload->class_code= $request->class_code;
        $workload->number_of_students= $request->number_of_students;
        $workload->total_workload= $request->total_workload;
        $workload->theoretical_hours= $request->theoretical_hours;
        $workload->practice_hours= $request->practice_hours;
        $workload->note= $request->note;
        $workload->unit_id= $request->unit_id;
        $workload->semester_id= $request->semester;
        if ($request->session_new == 0) {
            $workload->session_id= $request->session_id;
        } else {
            $workload_session = new WorkloadSession();
            $workload_session->start_year = $request->start_year;
            $workload_session->end_year = $request->end_year;
            $workload_session->save();
            $workload->session_id = $workload_session->id;
        }
        $workload->save();
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    public function getWorkloadDetail($id_workload)
    {
        $workload = Workload::find($id_workload);
        $pi = PI::find($workload->personalinformation_id);
        return view('admin.workload.workload-details', compact('workload', 'pi'));
    }

    public function getWorkloadList_Employee()
    {
        $pi = Auth::guard('employee')->user();
        $workloads_own_user = Workload::where('personalinformation_id', $pi->personalinformation_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $semester = Semester::all();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->first();//get current workload year study
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
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('employee.workload.workload-list', compact('semester_filter', 'semester', 'workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload', 'workload', 'pi'));
    }
    public function getWorkloadPIDetail($id)
    {
        $pi = Auth::guard('employee')->user()->pi;
        $workload = Workload::find($id);

        return view('employee.workload.workload-details-list', compact('workload', 'pi'));
    }
    public function delete($workload_id)
    {
        $workload = Workload::find($workload_id);
        $workload->delete();
        return redirect()->back()->with('message', 'Xóa thông tin nhân viên thành công');
    }

    public function import(Request $request)
    {
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
            $session_year = explode('-', $request->session_year);
            $workload_session = WorkloadSession::where('start_year', $session_year[0])->where('end_year', $session_year[1])->first();
            if ($workload_session!=null) {
                $session_id = $workload_session->id;
            } else {
                $session = WorkloadSession::create([
                    'start_year' => $session_year[0],
                    'end_year' => $session_year[1]
                ]);

                $session_id = $session->id;
            }
            Excel::import(new WorkloadImport($request->append, $session_id), $file);
            return redirect()->back()->with('message', 'Import thành công');
        }
    }

    public function getWorkloadDetail_Employee($id_workload)
    {
        $pi = Auth::guard('employee')->user();
        $workload = Workload::find($id_workload);
        if ($this->checkIsOwnerPermisson($pi, $workload)) {
            return view('employee.workload.workload-details', compact('workload', 'pi'));
        }
    }

    public function getdataimport(Request $request)
    {
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
                $arr_workload  = (new WorkloadImport(5, 5))->toArray($import_file);
                //[0][5] length of excel columns = 16 [0-15]
                if (count($arr_workload[0]) < 6) {
                    return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc. Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.workload.template.download').'"> (tải file mẫu)</a></small>']]);
                } else {
                    if (count($arr_workload[0][5]) == 16) {
                        return response()->json($arr_workload[0]);
                    } else {
                        return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc. Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.workload.template.download').'"> (tải file mẫu)</a></small>']]);
                    }
                }
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function downloadtemplate()
    {
        $file = public_path('Workload.xlsx');
        $headers = array(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, 'Template Job Workload.xlsx', $headers);
    }

    public function checkIsOwnerPermisson($current_user, $workload)
    {
        if ($current_user->can('access', $workload)) {
            return true;
        } else {
            return abort('403', 'Bạn không có quyền thực hiện thao tác này');
        }
    }
}
