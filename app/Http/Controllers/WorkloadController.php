<?php

namespace App\Http\Controllers;

use App\PI;
use App\Unit;
use Maatwebsite\Excel\Facades\Excel;
use App\Workload;
use App\WorkloadSession;
use App\Employee;
use App\Semester;
use Auth;
use App\Imports\WorkloadImport;
use Illuminate\Http\Request;

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
    public function getlistworkloadbypi($pi_id){
        //workload of own detail
        $workloads_own_user = Workload::where('personalinformation_id',$pi_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::all();
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
                    $q->where('subject_code','like', '%'.$search.'%')
                        ->orWhere('subject_name','like', '%'.$search.'%')
                        ->orWhere(function($q2) use ($search){
                            $q2->whereHas('unit',function ($q3) use ($search){
                                $q3->where('name', 'like', '%'.$search.'%')
                                    ->orWhere('unit_code','like', '%'.$search.'%');
                            });
                        });
                });

            }
            if ($semester_filter != null) {
                if($semester_filter !=4){
                    $query->whereHas('semester',function ($q) use ($semester_filter) {
                        $q->where('alias', $semester_filter);
                    });
                }

            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            }
            else if ($search ==null && $year_workload==null){
                $query->where('session_id',$workload_session_current_id);
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.pi.pi-workload-list', compact('semester_filter','semester','pi_id','workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));

    }
    //get
    public function getadd()
    {
        $workload = Workload::all();
        $se = Semester::all();
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        $unit = Unit::all();
        $pi = PI::all();
        return view('admin.workload.workload-add', compact('workload', 'pi', 'ws', 'se', 'unit'));
    }
    //post workload
    public function postadd(Request $request)
    {
        //get id employee

        $pp = strtoupper($request->employee_code);
        $pi = PI::where('employee_code', $pp)->first()->id;
        //add data
        $workload = new Workload();
        $workload->personalinformation_id = $pi;
        $workload->subject_code= strtoupper($request->subject_code);
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

        return redirect()->back()->with('message', 'Thêm thành công');
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
        $workloads_own_user = Workload::where('personalinformation_id',$pi->personalinformation_id);
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::all();
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
                    $q->where('subject_code','like', '%'.$search.'%')
                        ->orWhere('subject_name','like', '%'.$search.'%')
                        ->orWhere(function($q2) use ($search){
                            $q2->whereHas('unit',function ($q3) use ($search){
                                $q3->where('name', 'like', '%'.$search.'%')
                                    ->orWhere('unit_code','like', '%'.$search.'%');
                            });
                        });
                });

            }
            if ($semester_filter != null) {
                if($semester_filter !=4){
                    $query->whereHas('semester',function ($q) use ($semester_filter) {
                        $q->where('alias', $semester_filter);
                    });
                }

            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            }
            else if ($search ==null && $year_workload==null && $semester_filter ==null){
                $query->where('session_id',$workload_session_current_id);
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('employee.workload.workload-list', compact('semester_filter','semester','workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload', 'workload', 'pi'));
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

    public function import(Request $request){
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
            Excel::import(new WorkloadImport, $file);
            return redirect()->back()->with('message', 'Import thành công');
        }


    }

    public function getWorkloadDetail_Employee($id_workload){
        $pi = Auth::guard('employee')->user();
        $workload = Workload::find($id_workload);
        if($this->checkIsOwnerPermisson($pi,$workload)){
            return view('employee.workload.workload-details', compact('workload', 'pi'));
        }
    }

    public function checkIsOwnerPermisson($current_user,$workload){
        if ($current_user->can('access', $workload)) {
            return true;
        } else {
            return abort('403','Bạn không có quyền thực hiện thao tác này');
        }
    }
}
