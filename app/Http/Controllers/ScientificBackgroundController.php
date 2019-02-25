<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ScientificBackground;
use Auth;

class ScientificBackgroundController extends Controller
{
    public function getdetailAdmin($pi_id){
        $sb = ScientificBackground::where('personalinformation_id',$pi_id)->firstOrFail();
        return view('admin.sb.sb-detail', compact('pi_id','sb'));

    }
    public function getdetailEmployeeSB(){
        $pi_id = Auth::guard('employee')->user()->pi;

        $sb = ScientificBackground::where('personalinformation_id',$pi_id->id)->firstOrFail();
        return view('employee.sb.employee-sb-detail', compact('pi_id','sb'));

    }
}
