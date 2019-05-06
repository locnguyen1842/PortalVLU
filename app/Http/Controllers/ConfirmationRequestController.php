<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfirmationRequest;
use App\ConfirmationIncome;
use App\Notifications\ConfirmationRequestNotify;
use App\PI;
use App\Address;
use App\Notification;
use Auth;
use Carbon\Carbon;
use PDF;
class ConfirmationRequestController extends Controller
{

    public function index(){
        $search =  \Request::get('search');
        $status = \Request::get('status');

        if($status == 'undefined'){
            $status = null;
        }
        $crs = ConfirmationRequest::where(function ($query) use ($search,$status) {
            if ($search != null) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('pi', function ($q1) use ($search) {
                        $q1->where('employee_code', 'like', '%'.$search.'%')
                            ->orWhere('full_name', 'like', '%'.$search.'%');
                    });
                });
            }
            if ($status != null ) {
                $query->where(function ($q) use ($status) {
                    $q->where('status', 0);
                });
            };
        })->orderBy('date_of_request', 'desc')->paginate(10)->appends(['search'=>$search,'status'=>$status]);
        // $crs = ConfirmationRequest::where('status',1)->orderBy('date_of_request','desc')->paginate(10);
        $unread_noti = Notification::where('read_at',null)->get();
        foreach($unread_noti as $item){
            $item->read_at = Carbon::now();
            $item->save();
        }
        return view('admin.confirmation.index', compact('crs','search','status'));

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
                'confirmation'=> 'required',
                'number_of_month_income' =>'required_if:is_confirm_income,on',
            ],
            [
                'address.required' => 'Địa chỉ không được bỏ trống',
                'confirmation.required' => 'Lý do không được bỏ trống',
                'number_of_month_income.required_if' => 'Số tháng không được bỏ trống khi chọn xác nhận thu nhập',
            ]
        );
        $cr = new ConfirmationRequest;
        $cr->personalinformation_id = $pi->id;
        $cr->confirmation = $request->confirmation;
        $cr->address_id = $request->address;
        $cr->date_of_request = Carbon::now();
        $cr->status = 0;
        if($request->has('is_confirm_income')){
            $cr->is_confirm_income = 1;
            $cr->number_of_month_income = $request->number_of_month_income;

            $cr->save();

            for($i= 0 ; $i < $cr->number_of_month_income;$i++){
                if($i >= 12){
                    break;
                }
                $income = new ConfirmationIncome;
                $income->confirmation_request_id = $cr->id;
                $income->save();
            }

        }else{
            $cr->is_confirm_income = 0;
            $cr->save();
        }

        $cr->notify(new ConfirmationRequestNotify($cr));

        return redirect()->route('employee.confirmation.index')->with('message', 'Gửi đơn thành công');
    }


    public function previewEmployee($cr_id){
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $cr = ConfirmationRequest::findOrFail($cr_id);
        $this->authorize('preview', $cr);
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
        $this->authorize('access', $cr);
        return view('employee.confirmation.update', compact('pi','cr'));
    }
    public function postUpdate(Request $request,$cr_id){
        $pi = PI::findOrFail(Auth::guard('employee')->user()->personalinformation_id);
        $cr= ConfirmationRequest::findOrFail($cr_id);
        $this->authorize('access', $cr);
        $request->validate(
            [
                'address'=> 'required',
                'confirmation'=> 'required',
                'number_of_month_income' =>'required_if:is_confirm_income,on',
            ],
            [
                'address.required' => 'Địa chỉ không được bỏ trống',
                'confirmation.required' => 'Lý do không được bỏ trống',
                'number_of_month_income.required_if' => 'Số tháng không được bỏ trống khi chọn xác nhận thu nhập',
            ]
        );

        $cr->confirmation = $request->confirmation;
        $cr->address_id = $request->address;
        if($request->has('is_confirm_income')){
            $cr->is_confirm_income = 1;
            $cr->number_of_month_income = $request->number_of_month_income;
            $cr->save();
            if($cr->incomes()->exists()){
                foreach($cr->incomes as $item){
                    $item->delete();
                }
            }
            for($i= 0 ; $i < $cr->number_of_month_income;$i++){
                if($i >= 12){
                    break;
                }
                $income = new ConfirmationIncome;
                $income->confirmation_request_id = $cr->id;
                $income->save();
            }
        }else{
            if($cr->incomes()->exists()){
                foreach($cr->incomes as $item){
                    $item->delete();
                }
            }
            $cr->is_confirm_income = 0;
            $cr->save();
        }

        return redirect()->back()->with('message', 'Cập nhật đơn thành công');
    }

    public function print($cr_id){
        $cr = ConfirmationRequest::findOrFail($cr_id);
        $cr->status = 1 ;
        $cr->save();
        $pdf = PDF::loadView('admin.confirmation.print', compact('cr'));
        // return view('admin.confirmation.print',compact('cr'));
        return $pdf->stream('ly-lich-khoa-hoc.pdf');
    }

    public function delete($cr_id){
        $cr = ConfirmationRequest::findOrFail($cr_id);
        $this->authorize('access', $cr);
        ConfirmationIncome::where('confirmation_request_id',$cr->id)->delete();
        $cr->delete();
        return redirect()->back()->with('message', 'Xóa đơn thành công');
    }

    public function getUpdateAdmin($cr_id){
        $this->authorize('cud', PI::firstOrFail());
        $cr= ConfirmationRequest::findOrFail($cr_id);
        $pi = PI::findOrFail($cr->pi->id);
        return view('admin.confirmation.update', compact('pi','cr'));
    }
    public function postUpdateAdmin(Request $request,$cr_id){
        $this->authorize('cud', PI::firstOrFail());
        $cr= ConfirmationRequest::findOrFail($cr_id);
        $request->validate(
            [
                'confirmation'=> 'required',
                'first_signer'=> 'required',
                'second_signer'=> 'required',
                'name_of_signer'=> 'required',
                'month_of_income.*'=> 'required|integer|max:12|min:1',
                'year_of_income.*'=> 'required|integer|digits:4',
                'amount_of_income.*'=> 'required|numeric',

            ],
            [
                'confirmation.required' => 'Lý do không được bỏ trống',
                'first_signer.required' => 'Người ký cấp I không được bỏ trống',
                'second_signer.required' => 'Người ký cấp II không được bỏ trống',
                'name_of_signer.required' => 'Họ tên người ký không được bỏ trống',
                'month_of_income.*.required' => 'Tháng thu nhập không được bỏ trống',
                'month_of_income.*.integer' => 'Tháng thu nhập chỉ được nhập số nguyên',
                'month_of_income.*.max' => 'Tháng thu nhập không hợp lệ',
                'month_of_income.*.min' => 'Tháng thu nhập không hợp lệ',
                'year_of_income.*.required' => 'Năm thu nhập không được bỏ trống',
                'year_of_income.*.integer' => 'Năm thu nhập chỉ được nhập số nguyên',
                'year_of_income.*.digits' => 'Năm thu nhập chỉ được nhập số nguyên',
                'amount_of_income.*.required' => 'Thu nhập không được bỏ trống',
                'amount_of_income.*.numeric' => 'Thu nhập chỉ được nhập số',

            ]
        );
        if(($request->month_of_income) != null){
            $request->month_of_income = ($request->month_of_income);
            ConfirmationIncome::where('confirmation_request_id', $cr->id)->delete();
            for ($i = 0 ; $i < count($request->month_of_income) ; $i++) {
                $ci = new ConfirmationIncome;
                $ci->confirmation_request_id = $cr->id;

                $ci->month_of_income = $request->month_of_income[$i];
                $ci->year_of_income = $request->year_of_income[$i];
                $ci->amount_of_income = $request->amount_of_income[$i];
                $ci ->save();
            }
        }
        $cr->confirmation = $request->confirmation;
        $cr->first_signer = $request->first_signer;
        $cr->second_signer = $request->second_signer;
        $cr->name_of_signer = $request->name_of_signer;
        $cr->save();
        return redirect()->back()->with('message', 'Cập nhật đơn thành công');
    }
}
