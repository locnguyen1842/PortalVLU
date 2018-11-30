<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PI;

class PIController extends Controller
{
    public function index(){

      $search =  \Request::get('search');
      $pis = PI::where(function($query) use ($search){
            if($search != null){
                $query->where(function($q) use ($search){
                    $q->where('employee_code','like','%'.$search.'%');
                });

            }

        })->orderBy('first_name','decs')->paginate(10)->appends(['search'=>$search]);
      return view('pi.pi-list',compact('pis','search'));
    }


}
