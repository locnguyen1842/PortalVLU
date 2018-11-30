<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function getAdd()
    {
        return view('pi.pi-add');
    }
    public function postAdd(Request $request)
    {



        $pi = new PI;
        $pi->id= $request->id;
        $pi->employee_code= $request->employee_code;

        // $full_name = " ".$request->full_name;
        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation= $request->nation;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        $pi->permanent_address= $request->permanent_address;
        $pi->contact_address= $request->contact_address;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->position= $request->position;
        $pi->date_of_recruitment= $request->date_of_recruitment;
        $pi->professional_title= $request->professional_title;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        $pi->save();
        $employee = new Employee;
        $employee->personalinformation_id = $pi->id;
        $employee->username= $pi->employee_code;
        $employee->password = Hash::make($pi->employee_code);

        $employee->save();

        return redirect()->back();
    }
    //get data personal information
    public function getupdate($id){
        $pi = PI::Find($id);
        Return view('pi.pi-update',compact('pi'));
    }
    //post date update information
    public function postupdate(Request $request ,$id){
        $pi = PI::Find($id);
        $pi->id= $request->id;
        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation= $request->nation;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        $pi->permanent_address= $request->permanent_address;
        $pi->contact_address= $request->contact_address;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->position= $request->position;
        $pi->date_of_recruitment= $request->date_of_recruitment;
        $pi->professional_title= $request->professional_title;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        $pi->save();


        return redirect()->back();
    }

}
