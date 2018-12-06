<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Degree;
use App\DegreeDetail;
use App\Industry;
use App\PI;
class DegreeController extends Controller
{
  public function getupdatedegree($id)
  {
      $degrees = Degree::all();
      $industries = Industry::all();
      $pi = PI::find($id);

      return view('admin.pi.pi-updatedegree',compact('degrees','industries','pi'));
  }
  public function postupdatedegree(Request $request, $id)
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
