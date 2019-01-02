<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkloadSession;
use App\Workload;

class WorkloadController extends Controller
{
    public function index(){
        $max_year = WorkloadSession::max('end_year');
        $workload_session = WorkloadSession::all();
        $workload_session_current = WorkloadSession::where('end_year',$max_year)->first();//get current workload year study
        $year_workload = \Request::get('year_workload');
        $search =  \Request::get('search');
        $workloads_collection = Workload::where('session_id',$workload_session_current->id);
        //query if $search have a value
        $workloads = $workloads_collection->where(function ($query) use ($search,$year_workload) {
            if ($search != null) {
                $query->whereHas('pi',function ($q) use ($search) {
                    $q->where('employee_code', 'like', '%'.$search.'%')
                      ->orWhere('full_name', 'like', '%'.$search.'%');
                });
            }
            if($year_workload != null){
                $query->where(function ($q) use ($year_workload) {
                    $q->where('session_id',$year_workload);
                });
            }
        })->orderBy('updated_at', 'asc')->paginate(10)->appends(['search'=>$search,'year_workload'=>$year_workload]);

        return view('admin.workload.workload-list',compact('workload_session','workload_session_current','workloads','search','year_workload'));
    }
}
