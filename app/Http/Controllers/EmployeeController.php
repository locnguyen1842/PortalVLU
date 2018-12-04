<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class EmployeeController extends Controller
{
    public function getdetail(){
      $user_id = Auth::guard('employee')->user()->id;
      return view('employee.pi.pi-list');
    }

}
