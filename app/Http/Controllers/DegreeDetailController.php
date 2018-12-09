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
    public function getdegreelist($id)
    {
        $pi = PI::find($id);
        $degrees = DegreeDetail::where('personalinformation_id',$id)->orderBy('degree_id','asc')->paginate(10);
        return view('admin.pi.pi-degree-list', compact('degrees','pi'));
    }
    public function getupdatedegreedetail($degreedetail_id)
    {


        $degree = DegreeDetail::find($degreedetail_id);//where('personalinformation_id',$id)->where('degree_id',$b)->get();

        $pi = PI::find($degree->pi->id);
        $degrees = Degree::all();
        $industries = Industry::all();
        //$degreede = DegreeDetail::all();


        return view('admin.pi.pi-updatedegreedetail', compact('degrees','degree', 'industries','pi'));
    }
    public function postupdatedegreedetail(Request $request, $degreedetail_id)
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
        $degree = DegreeDetail::find($degreedetail_id);
        $degree->date_of_issue = $request->date_of_issue;
        $degree->place_of_issue = $request->place_of_issue;
        $degree->degree_id = $request->degree;
        $degree->industry_id = $request->industry;

        $degree->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
    public function getcreatedegree($id)
    {
        $degrees = Degree::all();
        $industries = Industry::all();
        $pi = PI::find($id);

        return view('admin.pi.pi-createdegreedetail', compact('degrees', 'industries', 'pi'));
    }
    public function postcreatedegree(Request $request, $id)
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
        $degree_detail = new DegreeDetail;
        $degree_detail->personalinformation_id = $pi->id;
        $degree_detail->date_of_issue = $request->date_of_issue;
        $degree_detail->place_of_issue = $request->place_of_issue;
        $degree_detail->degree_id = $request->degree;
        $degree_detail->industry_id = $request->industry;

        $degree_detail->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
}
