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
    public function getCreate(){
        // $this->authorize('cud', PI::firstOrFail());
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        return view('admin.confirmation.add', compact('pi'));
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
        $confirm_requests = new ConfirmationRequest;
        $confirm_requests->personalinformation_id = $pi->id;
        $confirm_requests->address_id = $request->address;
        $confirm_requests->reason = $request->reason;
        $confirm_requests->confirmation = $request->reason;
        $confirm_requests->date_of_request = Carbon::now('Asia/Ho_Chi_Minh');
        $confirm_requests->save();

        return redirect()->back()->with('message', 'Gửi đơn thành công');
    }   
}
