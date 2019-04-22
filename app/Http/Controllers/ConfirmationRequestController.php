<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfirmationRequest;

use App\PI;
use App\Address;
use Auth;
use Carbon\Carbon;
use PDF;
class ConfirmationRequestController extends Controller
{

    public function index(){
        $search =  \Request::get('search');
        $show_printed = \Request::get('show_printed');

        if($show_printed == 'undefined'){
            $show_printed = null;
        }
        $crs = ConfirmationRequest::where(function ($query) use ($search,$show_printed) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('pi', function ($q1) use ($search) {
                        $q1->where('employee_code', 'like', '%'.$search.'%')
                            ->orWhere('full_name', 'like', '%'.$search.'%');
                    });
                });
            }
            if ($show_printed != null ) {
                $query->where(function ($q) use ($show_printed) {
                    $q->where('is_printed', 0);
                });
            }
            $query->where('status',1);
        })->orderBy('date_of_request', 'desc')->paginate(10)->appends(['search'=>$search,'show_printed'=>$show_printed]);
        // $crs = ConfirmationRequest::where('status',1)->orderBy('date_of_request','desc')->paginate(10);

        return view('admin.confirmation.index', compact('crs','search','show_printed'));

    }
    public function indexEmployee(){
        $crs = ConfirmationRequest::where('personalinformation_id',Auth::guard('employee')->user()->personalinformation_id)->orderBy('created_at','desc')->paginate(10);

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
        return redirect()->route('employee.confirmation.index')->with('message', 'Tạo đơn thành công');
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
        $cr= ConfirmationRequest::findOrFail($cr_id);

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
        $cr= ConfirmationRequest::findOrFail($cr_id);
        $cr->reason = $request->reason;
        $cr->confirmation = $request->reason;
        $address = Address::findOrfail($request->address);
        $cr->address = $address->address_content .', '.$address->ward->path_with_type;
        $cr->address_id = $address->id;
        $cr->save();
        return redirect()->back()->with('message', 'Cập nhật đơn thành công');
    }

    public function print($cr_id){
        $cr = ConfirmationRequest::findOrFail($cr_id);
        $cr->is_printed = 1 ;
        $cr->save();
        $pdf = PDF::loadView('admin.confirmation.print', compact('cr'));
        // return view('admin.confirmation.print',compact('cr'));
        return $pdf->stream('ly-lich-khoa-hoc.pdf');
    }

    public function delete($cr_id){
        $cr = ConfirmationRequest::findOrFail($cr_id);
        $cr->delete();
        return redirect()->back()->with('message', 'Xóa đơn thành công');
    }

    public function getUpdateAdmin($cr_id){
        // $this->authorize('cud', PI::firstOrFail());
        $cr= ConfirmationRequest::find($cr_id);
        $pi = PI::findOrFail($cr->pi->id);
        return view('admin.confirmation.update', compact('pi','cr'));
    }
    public function postUpdateAdmin(Request $request,$cr_id){

        $request->validate(
            [
                'reason'=> 'required',
                'first_signer'=> 'required',
                'second_signer'=> 'required',
                'name_of_signer'=> 'required',
            ],
            [
                'reason.required' => 'Lý do không được bỏ trống',
                'first_signer.required' => 'Người ký cấp I không được bỏ trống',
                'second_signer.required' => 'Người ký cấp II không được bỏ trống',
                'name_of_signer.required' => 'Họ tên người ký không được bỏ trống',

            ]
        );
        $cr= ConfirmationRequest::find($cr_id);
        $cr->reason = $request->reason;
        $cr->confirmation = $request->reason;
        $cr->first_signer = $request->first_signer;
        $cr->second_signer = $request->second_signer;
        $cr->name_of_signer = $request->name_of_signer;
        $cr->save();
        return redirect()->back()->with('message', 'Cập nhật đơn thành công');
    }
}
