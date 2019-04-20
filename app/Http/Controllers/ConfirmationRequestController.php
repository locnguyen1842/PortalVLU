<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfirmationRequest;

use App\PI;
use App\Address;
use Auth;
use Carbon\Carbon;

class ConfirmationRequestController extends Controller
{

    public function index(){
        $crs = ConfirmationRequest::where('status',1)->paginate(10);

        return view('admin.confirmation.index', compact('crs'));

    }
    public function indexEmployee(){
        $crs = ConfirmationRequest::where('personalinformation_id',Auth::guard('employee')->user()->personalinformation_id)->paginate(10);

        return view('employee.confirmation.index', compact('crs'));

    }
    public function getCreate(){
        // $this->authorize('cud', PI::firstOrFail());
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        return view('employee.confirmation.create', compact('pi'));
    }
    public function postCreate(Request $request){
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $request->validate(
            [
                'address'=> 'required',
                'reason'=> 'required',
            ],
            [
                'address.required' => 'Địa chỉ không được bỏ trống',
                'reason.required' => 'Lý do không được bỏ trống',
            ]
        );
        $cr = new ConfirmationRequest;
        $cr->personalinformation_id = $pi->id;
        $cr->reason = $request->reason;
        $cr->confirmation = $request->reason;
        $address = Address::findOrfail($request->address);
        $cr->address = $address->address_content .', '.$address->ward->path_with_type;
        $cr->address_id = $address->id;
        $cr->status = 0;
        $cr->save();
        return redirect()->back()->with('message', 'Tạo đơn thành công');
    }

    public function sendRequest($cr_id){
        $cr = ConfirmationRequest::findOrFail($cr_id);
        $pi = PI::findOrFail($cr->personalinformation_id);
        $cr->date_of_request = Carbon::now();
        $cr->gender = $pi->gender;
        $cr->full_name = $pi->full_name;
        $cr->identity_card = $pi->identity_card;
        $cr->date_of_issue = $pi->date_of_issue;
        $cr->date_of_birth = $pi->date_of_birth;
        $cr->place_of_birth = $pi->place_of_birth;
        $cr->status = 1;
        $cr->save();
        return redirect()->back()->with('message', 'Gửi đơn thành công');

    }

    public function previewEmployee($cr_id){
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $cr = ConfirmationRequest::findOrFail($cr_id);
        return view('employee.confirmation.preview',compact('pi','cr'));
    }

    public function previewAdmin($cr_id){
        $cr = ConfirmationRequest::findOrFail($cr_id);
        return view('admin.confirmation.print',compact('cr'));
    }
    public function getUpdate($cr_id){
        // $this->authorize('cud', PI::firstOrFail());
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $cr= ConfirmationRequest::find($cr_id);
        return view('employee.confirmation.update', compact('pi','cr'));
    }
    public function postUpdate(Request $request,$cr_id){
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $request->validate(
            [
                'address'=> 'required',
                'reason'=> 'required',
            ],
            [
                'address.required' => 'Địa chỉ không được bỏ trống',
                'reason.required' => 'Lý do không được bỏ trống',
            ]
        );
        $cr= ConfirmationRequest::find($cr_id);
        $cr->reason = $request->reason;
        $cr->confirmation = $request->reason;
        $address = Address::findOrfail($request->address);
        $cr->address = $address->address_content .', '.$address->ward->path_with_type;
        $cr->address_id = $address->id;
        $cr->save();
        return redirect()->back()->with('message', 'Cập nhật đơn thành công');
    }
    

}
