<?php

namespace App\Http\Controllers;

use App\DegreeDetail;
use App\Degree;
use App\Industry;
use App\PI;
use Illuminate\Http\Request;

class DegreeDetailController extends Controller
{
    //get degree
    public function getdegreedetail($id, $b)
    {
        $pi = PI::find($id);

        $degrees = DegreeDetail::where('personalinformation_id',$id)->where('degree_id',$b)->get();


        $degree = Degree::where('id',$b);
        $industries = Industry::all();
        //$degreede = DegreeDetail::all();


        return view('admin.pi.pi-degreedetail', compact('degrees', 'industries','pi'));
    }
    public function getupdatedegreedetail($id, $b)
    {
        $pi = PI::find($id);

        $degree = DegreeDetail::find($b);//where('personalinformation_id',$id)->where('degree_id',$b)->get();


        $degrees = Degree::all();
        $industries = Industry::all();
        //$degreede = DegreeDetail::all();


        return view('admin.pi.pi-updatedetaildegree', compact('degrees','degree', 'industries','pi'));
    }
    public function postupdatedegreedetail(Request $request, $id,$b)
    {
        $request->validate(
            [
                'date_of_issue'=> 'required|date',
                'place_of_issue'=> 'required',
                'degree'=> 'required',
                'industry'=> 'required'
            ],
            [
                'date_of_issue.required' => 'Ngày cấp không được bỏ trống',
                'date_of_issue.date' => 'Ngày cấp không đúng định dạng',
                'degree.required' => 'Bằng cấp không được bỏ trống',
                'industry.required' => 'Khối ngành không được bỏ trống',
                'place_of_issue.required' => 'Nơi cấp không được bỏ trống'
            ]
        );
        $pi = PI::find($id);
        $degree = DegreeDetail::find($b);
//        dd($degree);
        $degree->date_of_issue = $request->date_of_issue;
        $degree->place_of_issue = $request->place_of_issue;
        $degree->degree_id = $request->degree;
        $degree->industry_id = $request->industry;

        $degree->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
}
