<?php

namespace App\Http\Controllers;

use App\PI;
use App\Unit;
use App\Workload;
use App\WorkloadSession;
use App\Employee;
use Auth;
use Illuminate\Http\Request;

class WorkloadController extends Controller
{
    public function index()
    {
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::all();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->first();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $search =  \Request::get('search');
        $workloads_collection = Workload::where('session_id', $workload_session_current->id);
        //query if $search have a value
        $workloads = $workloads_collection->where(function ($query) use ($search,$year_workload) {
            if ($search != null) {
                $query->whereHas('pi', function ($q) use ($search) {
                    $q->where('employee_code', 'like', '%'.$search.'%')
                      ->orWhere('full_name', 'like', '%'.$search.'%');
                });
            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.workload.workload-list', compact('workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload'));
    }
    //get
    public function getadd()
    {
        $workload = Workload::all();
        $ws = WorkloadSession::all();
        $unit = Unit::all();
        $pi = PI::all();
        return view('admin.workload.workload-add', compact('workload', 'pi', 'ws', 'unit'));
    }
    //post workload
    public function postadd(Request $request)
    {
        //get id employee
        $pp = strtoupper($request->employee_code);
        $pi = PI::where('employee_code',$pp)->first()->id;
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
        $workload->semester= $request->semester;
        $workload->session_id= $request->session_id;
        $workload->save();

        return redirect()->back()->with('message', 'Thêm thành công');
    }
    //
    public function getUpdateWorkload($workload_id)
    {
        $workload = Workload::find($workload_id);
        $pi = PI::find($workload->pi->id);
        $ws = WorkloadSession::all();
        $unit = Unit::all();

        return view('admin.workload.workload-update', compact('workload', 'pi', 'ws', 'unit'));
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
        $workload->semester= $request->semester;
        $workload->session_id= $request->session_id;
        $workload->save();
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }


    public function getaddEmployee()
    {
        $workload = Workload::all();
        $ws = WorkloadSession::all();
        $unit = Unit::all();
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        return view('employee.workload.employee-workload-add', compact('workload', 'pi', 'ws', 'unit'));
    }
    //post workload
    public function postaddEmployee(Request $request)
    {
        //
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        //add data
        $workload = new Workload();
        $workload->personalinformation_id = $pi->id;
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
        $workload->semester= $request->semester;
        $workload->session_id= $request->session_id;
        $workload->save();

        return redirect()->back()->with('message', 'Thêm thành công');
    }
    public function getWorkloadPIList($id)
    {
        $workload = Workload::find($id);
        $pi = PI::find($workload->personalinformation_id);
        return view('admin.workload.workload-details-list', compact('workload', 'pi'));
    }

    public function indexEmployee()
    {

        $pi = Auth::guard('employee')->user()->pi;
        $workload = Workload::where('personalinformation_id',$pi->id)->get();
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::all();
        $workload_session_current = WorkloadSession::where('end_year', $max_year)->first();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $search =  \Request::get('search');
        $workloads_collection = Workload::where('session_id', $workload_session_current->id);
        //query if $search have a value
        $workloads = $workloads_collection->where(function ($query) use ($search,$year_workload) {
            if ($search != null) {
                $query->whereHas('pi', function ($q) use ($search) {
                    $q->where('employee_code', 'like', '%'.$search.'%')
                      ->orWhere('full_name', 'like', '%'.$search.'%');
                });
            }
            if ($year_workload != null) {
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id', $year_workload);
                });
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('employee.workload.employee-workload-list', compact('workload_session', 'workload_session_current', 'workloads', 'search', 'year_workload','workload','pi'));
    }
    public function getWorkloadPIDetail()
    {
      $pi = Auth::guard('employee')->user()->pi;
      $units = Unit::all();
      $dh_count = $pi->degreedetails->where('degree_id', 1)->count();
      $ths_count = $pi->degreedetails->where('degree_id', 2)->count();
      $ts_count = $pi->degreedetails->where('degree_id', 3)->count();
      return view('employee.pi.pi-detail', compact('pi', 'employee', 'dh_count', 'ths_count', 'ts_count'));
    }
    public function delete($workload_id){
        $workload = Workload::find($workload_id);
        $workload->delete();
        return redirect()->back()->with('message', 'Xóa thông tin nhân viên thành công');
    }

    public function deleteEmployeeworkload($workload_id){
        $workload = Workload::find($workload_id);
        $workload->delete();
        return redirect()->back()->with('message', 'Xóa thông tin nhân viên thành công');
    }



}
