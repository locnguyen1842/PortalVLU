<?php

namespace App\Http\Controllers;

use App\PI;
use App\Unit;
use App\Workload;
use App\WorkloadSession;
use Illuminate\Http\Request;

class WorkloadController extends Controller
{
    public function index(){
    }
    //get
    public function getadd($id){
        $workload = Workload::all();
        $ws = WorkloadSession::all();
        $unit = Unit::all();
        $pi = PI::find($id);
        return view('admin.workload.workload-add', compact('workload','pi','ws','unit'));
    }
    //post workload
    public function postadd(Request $request , $id){
        //
        $pi = PI::find($id);
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

}
