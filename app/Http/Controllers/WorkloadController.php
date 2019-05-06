<?php

namespace App\Http\Controllers;

use App\PI;
use App\Unit;
use Maatwebsite\Excel\Facades\Excel;
use App\Workload;
use App\ScientificResearchWorkload;
use App\WorkloadSession;
use Validator;
use App\Employee;
use App\Semester;
use Auth;
use App\Imports\AdminWorkloadImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkloadController extends Controller
{
    public function index()
    {
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->firstOrFail();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $search =  \Request::get('search');
        $workload_session_current_id = $workload_session_current->id;
        //query if $search have a value
        $workloads = Workload::where(function ($query) use ($search,$year_workload,$workload_session_current_id) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('pi', function ($q1) use ($search) {
                        $q1->where('employee_code', 'like', '%'.$search.'%')
                            ->orWhere('full_name', 'like', '%'.$search.'%');
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
        })->orderBy('updated_at', 'desc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.workload.workload-list', compact('workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));
    }

    public function srworkload_index()
    {
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->firstOrFail();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $search =  \Request::get('search');
        $workload_session_current_id = $workload_session_current->id;
        //query if $search have a value
        $workloads = ScientificResearchWorkload::where(function ($query) use ($search,$year_workload,$workload_session_current_id) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('pi', function ($q1) use ($search) {
                        $q1->where('employee_code', 'like', '%'.$search.'%')
                            ->orWhere('full_name', 'like', '%'.$search.'%');
                    });
                });
            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            } elseif ($search ==null && $year_workload==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'desc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.workload.srworkload-list', compact('workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));
    }

    public function getlistworkloadbypi($pi_id)
    {
        //workload of own detail
        $workloads_own_user = Workload::where('personalinformation_id', $pi_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $semester = Semester::all();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->firstOrFail();//get current workload year study
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
        })->orderBy('updated_at', 'decs')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.pi.pi-workload-list', compact('semester_filter', 'semester', 'pi_id', 'workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));
    }

    public function getlistsrworkloadbypi($pi_id)
    {
        //workload of own detail
        $workloads_own_user = ScientificResearchWorkload::where('personalinformation_id', $pi_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->firstOrFail();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $workload_session_current_id = $workload_session_current->id;

        //query if $search have a value
        $workloads = $workloads_own_user->where(function ($query) use ($year_workload,$workload_session_current_id) {

            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            } elseif ($year_workload==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'decs')->paginate(10)->appends(['year_workload'=>$year_workload]);

        return view('admin.pi.pi-srworkload-list', compact(  'pi_id', 'workload_session', 'workload_session_current', 'workloads', 'year_workload'));
    }
    //get
    public function getadd()
    {
        $this->authorize('cud', PI::firstOrFail());

        $workload = Workload::all();
        $id = \Request::get('pi_id');
        $data_append = \Request::get('data_html');
        $se = Semester::all();
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        $unit = Unit::all();

        if ($id != null) {
            $pi = PI::findOrFail($id);
        } else {
            $pi = null;
        }

        return view('admin.workload.workload-add', compact('workload', 'pi', 'ws', 'se', 'unit'));
    }
    //post workload
    public function postadd(Request $request)
    {
        $this->authorize('cud', PI::firstOrFail());

        $value_start_year = (int)\Request::get('start_year');
        $validator=Validator::make(
            $request->all(),
            [
                'employee_code'=> 'required|min:4|max:60|exists:personalinformations',
                'session_id'=> 'required_if:session_new,==,0',
                'session_new'=> 'required',
                'start_year'=> 'required_if:session_new,==,1|integer|nullable|unique:workloadsessions,start_year|digits:4',
                'end_year'=>    [
                                    'required_if:session_new,==,1',
                                    'digits:4',
                                    'integer',
                                    'nullable',
                                    function ($attribute, $value, $fail) use ($value_start_year) {
                                        $value_end_year = (int)$value;

                                        if ($value_end_year - $value_start_year != 1) {
                                            $fail('Năm kết thúc phải lớn hơn năm bắt đầu 1 năm');
                                        }
                                    }
                                ],

                'subject_code.*'=>'required|string|alpha_num',
                'subject_name.*'=> 'required|string',
                'number_of_lessons.*'=> 'required|integer|max:10000000',
                'number_of_students.*'=> 'required|integer|max:10000000',
                'class_code.*'=> 'required|string',
                'total_workload.*'=> 'required|numeric|max:10000000',
                'theoretical_hours.*'=> 'required|numeric|max:10000000',
                'semester.*' => 'required',
                'practice_hours.*'=> 'required|numeric|max:10000000',
                'unit_id.*' => 'required'
            ],
            [
                'employee_code.required'=> 'Mã giảng viên không được bỏ trống',
                'employee_code.exists'=> 'Mã giảng viên không tồn tại',
                'session_id.required_if' =>'Năm học không được bỏ trống',
                'session_new.required' =>'Năm học không được bỏ trống',
                'start_year.required_if' =>'Năm học bắt đầu không được bỏ trống',
                'end_year.required_if' =>'Năm học kết thúc không được bỏ trống',
                'start_year.integer' =>'Năm học bắt đầu chỉ được nhập số nguyên',
                'start_year.digits' =>'Năm học bắt đầu chỉ được nhập đúng 4 ký tự',
                'start_year.unique' =>'Năm học bắt đầu đã tồn tại trong danh sách',

                'end_year.integer' =>'Năm học kết thúc chỉ được nhập số nguyên',
                'end_year.digits'=> 'Năm học kết thúc chỉ được nhập đúng 4 ký tự',
                'number_of_lessons.*.integer' =>'Số tiết học chỉ được nhập số nguyên',
                'number_of_students.*.integer' =>'Số sinh viên chỉ được nhập số nguyên',
                'total_workload.*.numeric' =>'Tổng khối lượng công việc chỉ được nhập số',
                'practice_hours.*.numeric' =>'Số giờ thực hành chỉ được nhập số',
                'theoretical_hours.*.numeric' =>'Số giờ lý thuyết chỉ được nhập số',
                'employee_code.min' =>'Họ và tên phải lớn hơn 4 kí tự',
                'employee_code.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
                'subject_code.*.required' =>'Mã môn học không được bỏ trống',
                'subject_code.*.string' =>'Mã môn học chỉ được nhập ký tự',
                'subject_code.*.alpha_num' =>'Mã môn học không có ký tự đặc biệt',
                'subject_name.*.string' =>'Tên môn học chỉ được nhập ký tự',
                'class_code.*.string' =>'Mã lớp học chỉ được nhập ký tự',
                'subject_name.*.required' =>'Tên môn học không được bỏ trống',
                'number_of_lessons.*.required' =>'Số tiết học không được bỏ trống',
                'number_of_lessons.*.max' =>'Số tiết học không hợp lệ',
                'number_of_students.*.required' =>'Số sinh viên không được bỏ trống',
                'number_of_students.*.max' =>'Số sinh viên không hợp lệ',
                'class_code.*.required' =>'Mã lớp học không được bỏ trống',
                'total_workload.*.required' =>'Tổng khối lượng công việc không được bỏ trống',
                'total_workload.*.max' =>'Tổng khối lượng công việc không hợp lệ',
                'theoretical_hours.*.required' =>'Số giờ lý thuyết không được bỏ trống',
                'theoretical_hours.*.max' =>'Số giờ lý thuyết không hợp lệ',
                'semester.*.required' =>'Học kỳ không được bỏ trống',
                'practice_hours.*.required' =>'Số giờ thực hành không được bỏ trống',
                'practice_hours.*.max' =>'Số giờ thực hành không hợp lệ',
                'unit_id.*.required' =>'Đơn vị không được bỏ trống',
            ]
        );
        if ($validator->passes()) {
            //get id employee

            $pp = strtoupper($request->employee_code);
            $pi = PI::where('employee_code', $pp)->firstOrFail();
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
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    //
    public function getUpdateWorkload($workload_id)
    {
        $this->authorize('cud', PI::firstOrFail());

        $se = Semester::all();
        $workload = Workload::findOrFail($workload_id);
        $pi = PI::findOrFail($workload->pi->id);
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        $unit = Unit::all();

        return view('admin.workload.workload-update', compact('workload', 'pi', 'ws', 'se', 'unit'));
    }

    public function postUpdateWorkload(Request $request, $workload_id)
    {
        $this->authorize('cud', PI::firstOrFail());

        $value_start_year = (int)\Request::get('start_year');
        $request->validate(
        [
          'subject_code'=> 'required|alpha_num',
          'subject_name'=> 'required',
          'number_of_lessons'=> 'required|integer|max:10000000',
          'class_code'=>'required',
          'number_of_students'=> 'required|integer|max:10000000',
          'total_workload'=> 'required|numeric|max:10000000',
          'theoretical_hours'=> 'required|numeric|max:10000000',
          'practice_hours'=> 'required|numeric|max:10000000',
          'unit_id'=> 'required',
          'semester' => 'required',
          'session_id' => 'required_if:session_new,==,0',
          'start_year' => 'required_if:session_new,==,1|nullable|unique:workloadsessions,start_year|digits:4',

          'end_year' => [
                            'required_if:session_new,==,1',
                            'gt:start_year',
                            'digits:4',
                            'integer',
                            'nullable',
                            function ($attribute, $value, $fail) use ($value_start_year) {
                                $value_end_year = (int)$value;

                                if ($value_end_year - $value_start_year != 1) {
                                    $fail('Năm kết thúc phải lớn hơn năm bắt đầu 1 năm');
                                }
                            }
                        ],
        ],
        [
          'subject_code.required'=> 'Mã môn học không được bỏ trống',
          'subject_code.alpha_num'=> 'Mã môn học không có tự đặc biệt',
          'subject_name.required'=> 'Tên môn học không được bỏ trống',
          'number_of_lessons.required'=> 'Số tiết học không được bỏ trống',
          'number_of_lessons.integer'=> 'Số tiết học chi được nhập số nguyên',
          'number_of_lessons.max'=> 'Số tiết học không hợp lệ',
          'class_code.required'=> 'Mã lớp học không được bỏ trống',
          'number_of_students.required'=> 'Số sinh viên không được bỏ trống',
          'number_of_students.integer'=> 'Số sinh viên chi được nhập số nguyên',
          'number_of_students.max'=> 'Số sinh viên không hợp lệ',
          'total_workload.required'=> 'Tổng số giờ không được bỏ trống',
          'total_workload.numeric'=> 'Tổng số giờ chi được nhập số',
          'total_workload.max'=> 'Tổng số giờ không hợp lệ',
          'theoretical_hours.required'=> 'Giờ lý thuyết không được bỏ trống',
          'theoretical_hours.numeric'=> 'Giờ lý thuyết chỉ được nhập số',
          'theoretical_hours.max'=> 'Giờ lý thuyết không hợp lệ',
          'practice_hours.required'=> 'Giờ thực hành không được bỏ trống',
          'practice_hours.numeric'=> 'Giờ thực hành chỉ được nhập số',
          'practice_hours.max'=> 'Giờ thực hành không hợp lệ',
          'unit.required'=> 'Đơn vị không được bỏ trống',
          'semester.required'=> 'Học kì không được bỏ trống',
          'session_id.required'=> 'Năm học không được bỏ trống',
          'start_year.required_if'=> 'Năm học bắt đầu không được bỏ trống',
          'start_year.unique'=> 'Năm học đã tồn tại trong danh sách',
          'start_year.digits'=> 'Năm học bắt đầu chỉ được nhập đúng 4 ký tự',
          'end_year.required_if'=> 'Năm học kết thúc không được bỏ trống',
          'end_year.gt'=> 'Năm học kết thúc phải lớn hơn năm bắt đầu 1 năm',
          'end_year.digits'=> 'Năm học kết thúc chỉ được nhập đúng 4 ký tự',

        ]
    );

        $workload = Workload::findOrFail($workload_id);
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
        $workload = Workload::findOrFail($id_workload);
        $pi = PI::findOrFail($workload->personalinformation_id);
        return view('admin.workload.workload-details', compact('workload', 'pi'));
    }

    public function getWorkloadList_Employee()
    {
        $pi = Auth::guard('employee')->user();
        $workloads_own_user = Workload::where('personalinformation_id', $pi->personalinformation_id);
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
            } elseif ($year_workload==null && $semester_filter ==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'desc')->get();

        return view('employee.workload.workload-list', compact('semester_filter', 'semester', 'workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload', 'pi'));
    }
    public function getSRWorkloadList_Employee()
    {
        $pi = Auth::guard('employee')->user();
        $workloads_own_user = ScientificResearchWorkload::where('personalinformation_id', $pi->personalinformation_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::orderBy('start_year', 'desc')->get();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->firstOrFail();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $workload_session_current_id = $workload_session_current->id;


        //query if $search have a value
        $workloads = $workloads_own_user->where(function ($query) use ($year_workload,$workload_session_current_id) {

            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            } elseif ($year_workload==null) {
                $query->where('session_id', $workload_session_current_id);
            }
        })->orderBy('updated_at', 'desc')->paginate(10);

        return view('employee.workload.srworkload-list', compact('workload_session', 'workload_session_current', 'workloads', 'year_workload', 'pi'));
    }
    public function delete($workload_id)
    {
        $this->authorize('cud', PI::firstOrFail());

        $workload = Workload::findOrFail($workload_id);
        $workload->delete();
        return redirect()->back()->with('message', 'Xóa thông tin khối lượng giảng dạy thành công');
    }

    public function import(Request $request)
    {
        $this->authorize('cud', PI::firstOrFail());
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
            $workload_session = WorkloadSession::where('start_year', $session_year[0])->where('end_year', $session_year[1])->firstOrFail();

            if ($workload_session!=null) {
                $session_id = $workload_session->id;
            } else {
                $session = WorkloadSession::create([
                    'start_year' => $session_year[0],
                    'end_year' => $session_year[1]
                ]);

                $session_id = $session->id;
            }
            Excel::import(new AdminWorkloadImport($request->append, $session_id), $file);
            return redirect()->back()->with('message', 'Import thành công');
        }
    }

    public function getWorkloadDetail_Employee($id_workload)
    {
        $pi = Auth::guard('employee')->user();
        $workload = Workload::findOrFail($id_workload);
        if ($this->checkIsOwnerPermisson($pi, $workload)) {
            return view('employee.workload.workload-details', compact('workload', 'pi'));
        } else {
            return abort('403');
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
                $arr_workload  = (new AdminWorkloadImport(5, 5))->toArray($import_file);
                $number_of_sheet = 2;
                $excel_column_length_sheet_1 = 16;
                $excel_column_length_sheet_2 = 11;
                //[0][5] length of excel columns = 16 [0-15]
                if(count($arr_workload) > 1){
                    if(count($arr_workload[0][5]) >= $excel_column_length_sheet_1){
                       if(count($arr_workload[1][5]) >= $excel_column_length_sheet_2){
                            return response()->json($arr_workload);
                       }else{
                            return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc (Sheet 2). Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.workload.template.download').'"> (tải file mẫu)</a></small>']]);
                       }
                    }else{
                        return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc (Sheet 1). Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.workload.template.download').'"> (tải file mẫu)</a></small>']]);
                    }
                }else{
                    return response()->json(['error'=>[0=>'File tải lên không đúng cấu trúc. Vui lòng xem lại file mẫu <small> '.'<a href="'.route('admin.workload.template.download').'"> (tải file mẫu)</a></small>']]);
                }
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function downloadtemplate()
    {
        $file = public_path('template-workload.xlsx');
        $headers = array(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($file, 'Template Workload.xlsx', $headers);
    }

    public function fetch()
    {
        $query = \Request::get('query');
        $pi = PI::select('employee_code', 'full_name')->where('employee_code', 'like', '%'.$query.'%')->get();
        return response()->json($pi);
    }

    public function checkIsOwnerPermisson($current_user, $workload)
    {
        if ($current_user->can('access', $workload)) {
            return true;
        } else {
            return abort('403', 'Bạn không có quyền thực hiện thao tác này');
        }
    }
    public function getyear()
    {
        $yearlist = WorkloadSession::orderBy('start_year', 'desc')->paginate(10);

        return view('admin.schoolyear.year-list', compact('yearlist'));
    }
    public function getaddyear()
    {
        $this->authorize('cud', PI::firstOrFail());

        return view('admin.schoolyear.schoolyear-add');
    }
    public function postaddyear(Request $request)
    {
        $this->authorize('cud', PI::firstOrFail());

        $value_start_year = (int)\Request::get('start_year');
        $request->validate(
            [

                'start_year'=> 'required|integer|digits:4',
                'end_year'=>    [
                    'required',
                    'digits:4',
                    'integer',
                    'nullable',
                    function ($attribute, $value, $fail) use ($value_start_year) {
                        $value_end_year = (int)$value;

                        if ($value_end_year - $value_start_year != 1) {
                            $fail('Năm kết thúc phải lớn hơn năm bắt đầu 1 năm');
                        }
                    }
                ],


            ],
            [
                'start_year.required'=> 'Năm bắt đầu không được bỏ trống',
                'start_year.digits'=> 'Năm bắt đầu chỉ được nhập đúng 4 ký tự',
                'start_year.integer'=> 'Năm bắt đầu chỉ được nhập số nguyên',
                'end_year.required'=> 'Năm kết thúc không được bỏ trống',
                'end_year.digits'=> 'Năm kết thúc chỉ được nhập đúng 4 ký tự',
                'end_year.integer'=> 'Năm kết thúc chỉ được nhập số nguyên',

            ]
        );
        $yearlist = new WorkloadSession();
        $yearlist->id = $request->id;
        $yearlist->start_year = $request->start_year;
        $yearlist->end_year = $request->end_year;
        $yearlist->save();

        return redirect()->back()->with('message', 'Thêm thành công');
    }
    public function getupdateyear($id)
    {
        $this->authorize('cud', PI::firstOrFail());

        $yearlist = WorkloadSession::Find($id);
        return view('admin.schoolyear.schoolyear-update', compact('yearlist'));
    }
    public function postupdateyear(Request $request, $id)
    {
        $this->authorize('cud', PI::firstOrFail());

        $value_start_year = (int)\Request::get('start_year');
        $request->validate(
            [

                'start_year'=> 'required|integer|digits:4',
                'end_year'=>    [
                    'required',
                    'digits:4',
                    'integer',
                    'nullable',
                    function ($attribute, $value, $fail) use ($value_start_year) {
                        $value_end_year = (int)$value;

                        if ($value_end_year - $value_start_year != 1) {
                            $fail('Năm kết thúc phải lớn hơn năm bắt đầu 1 năm');
                        }
                    }
                ],


            ],
            [
                'start_year.required'=> 'Năm bắt đầu không được bỏ trống',
                'start_year.digits'=> 'Năm bắt đầu chỉ được nhập đúng 4 ký tự',
                'start_year.integer'=> 'Năm bắt đầu chỉ được nhập số nguyên',
                'end_year.required'=> 'Năm kết thúc không được bỏ trống',
                'end_year.digits'=> 'Năm kết thúc chỉ được nhập đúng 4 ký tự',
                'end_year.integer'=> 'Năm kết thúc chỉ được nhập số nguyên',

            ]
        );
        $yearlist = WorkloadSession::Find($id);
        $yearlist->id = $request->id;
        $yearlist->start_year = $request->start_year;
        $yearlist->end_year = $request->end_year;
        $yearlist->save();

        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    public function deleteschoolyear($id)
    {
        $this->authorize('cud', PI::firstOrFail());

        $school_year = WorkloadSession::findOrFail($id);
        Workload::where('session_id', $school_year->id)->delete();
        ScientificResearchWorkload::where('session_id', $school_year->id)->delete();
        $school_year->delete();
        return redirect()->back()->with('message', 'Xóa năm học thành công');
    }



}
