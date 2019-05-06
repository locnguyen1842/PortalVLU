<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScientificResearchWorkload;
use App\PI;
use App\WorkloadSession;
use App\Workload;


class ScientificResearhWorkloadController extends Controller
{
    public function getAdd(){
        $this->authorize('cud', PI::firstOrFail());
        $id = \Request::get('pi_id');
        $data_append = \Request::get('data_html');
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        if ($id != null) {
            $pi = PI::findOrFail($id);
        } else {
            $pi = null;
        }

        return view('admin.scientific.scientific-add', compact('pi', 'ws'));
    }
    public function postAdd(Request $request){
        $this->authorize('cud', PI::firstOrFail());
        $value_start_year = (int)\Request::get('start_year');
        $request->validate(
            [
                'name_of_work' => 'required|max:1000',
                'detail_of_work' => 'required|max:1000',
                'explain_of_work' => 'required|max:1000',
                'unit_of_work' => 'required|max:1000',
                'note' => 'max:1000',
                'quantity_of_work' => 'required|numeric|max:10000000',
                'converted_standard_time' => 'required|numeric|max:10000000',
                'converted_time' => 'required|numeric|max:10000000',
                'session_id'=> 'required_if:session_new,==,0',
                'session_new'=> 'required',
                'start_year'=> 'required_if:session_new,==,1|integer|nullable|unique:workloadsessions,start_year',
                'end_year'=>    [
                                    'required_if:session_new,==,1',
                                    'digits:4',
                                    'integer',
                                    'nullable',
                                    function ($attribute, $value, $fail) use ($value_start_year) {
                                        $value_end_year = (int)$value;

                                        if ($value_end_year - $value_start_year != 1) {
                                            $fail('Năm kết thúc phải lớn hơn năm bắt đầu 1 năm');
                                        }
                                    }
                                ],

            ],
            [
                'name_of_work.required'=> 'Tên công việc không được bỏ trống',
                'detail_of_work.required'=> 'Chi tiết công việc không được bỏ trống',
                'explain_of_work.required'=> 'Diễn giải công việc không được bỏ trống',
                'unit_of_work.required'=> 'Đơn vị không được bỏ trống',
                'name_of_work.max'=> 'Tên công việc chỉ được chứa 1000 ký tự',
                'detail_of_work.max'=> 'Chi tiết công việc chỉ được chứa 1000 ký tự',
                'explain_of_work.max'=> 'Diễn giải công việc chỉ được chứa 1000 ký tự',
                'unit_of_work.max'=> 'Đơn vị chỉ được chứa 1000 ký tự',
                'note.max'=> 'Ghi chú chỉ được chứa 1000 ký tự',
                'quantity_of_work.required'=> 'Số lượng không được bỏ trống',
                'converted_standard_time.required'=> 'Quy đổi giờ chuẩn không được bỏ trống',
                'converted_time.required'=> 'Số tiết/giờ quy đổi không được bỏ trống',
                'quantity_of_work.numeric'=> 'Số lượng chỉ được nhập số',
                'converted_standard_time.numeric'=> 'Quy đổi giờ chuẩn chỉ được nhập số',
                'converted_time.numeric'=> 'Số tiết/giờ quy đổi chỉ được nhập số',
                'quantity_of_work.max'=> 'Số lượng không hợp lệ',
                'converted_standard_time.max'=> 'Quy đổi giờ chuẩn không hợp lệ',
                'converted_time.max'=> 'Số tiết/giờ quy đổi không hợp lệ',
                'session_id.required_if' =>'Năm học không được bỏ trống',
                'session_new.required' =>'Năm học không được bỏ trống',
                'start_year.required_if' =>'Năm học bắt đầu không được bỏ trống',
                'end_year.required_if' =>'Năm học kết thúc không được bỏ trống',
                'start_year.integer' =>'Năm học bắt đầu phải là số nguyên',
                'start_year.unique' =>'Năm học bắt đầu đã tồn tại trong danh sách',
                'end_year.integer' =>'Năm học kết thúc phải số nguyên',
                'end_year.digits'=> 'Năm học kết thúc phải đúng 4 ký tự',
            ]
                        );
        $srworkload = new ScientificResearchWorkload;
        $pp = strtoupper($request->employee_code);
        $pi = PI::where('employee_code', $pp)->firstOrFail();
        $srworkload->personalinformation_id = $pi->id;
        if ($request->session_new == 0) {
            $srworkload->session_id= $request->session_id;
        } else {
            $workload_session = new WorkloadSession();
            $workload_session->start_year = $request->start_year;
            $workload_session->end_year = $request->end_year;
            $workload_session->save();
            $srworkload->session_id = $workload_session->id;
        }
        $srworkload->name_of_work = $request->name_of_work;
        $srworkload->detail_of_work = $request->detail_of_work;
        $srworkload->explain_of_work = $request->explain_of_work;
        $srworkload->unit_of_work = $request->unit_of_work;
        $srworkload->quantity_of_work = $request->quantity_of_work;
        $srworkload->converted_standard_time = $request->converted_standard_time;
        $srworkload->converted_time = $request->converted_time;
        $srworkload->note = $request->note;
        $srworkload->save();

        return redirect()->back()->with('message', 'Thêm thành công');
    }

    public function getSRWorkloadDetail($id_srworkload)
    {
        $srworkload = ScientificResearchWorkload::findOrFail($id_srworkload);
        $pi = PI::findOrFail($srworkload->personalinformation_id);
        return view('admin.scientific.srworkload-details', compact('srworkload', 'pi'));
    }

    public function getUpdate($id_srworkload){
        $this->authorize('cud', PI::firstOrFail());
        $srworkload = ScientificResearchWorkload::findOrFail($id_srworkload);
        $pi = PI::findOrFail($srworkload->pi->id);
        $ws = WorkloadSession::orderBy('start_year', 'desc')->get();
        return view('admin.scientific.scientific-update', compact('srworkload', 'pi','ws'));
    }

    public function postUpdate(Request $request, $id_srworkload){
        $this->authorize('cud', PI::firstOrFail());
        $value_start_year = (int)\Request::get('start_year');
        $request->validate(
            [
                'name_of_work' => 'required|max:1000',
                'detail_of_work' => 'required|max:1000',
                'explain_of_work' => 'required|max:1000',
                'unit_of_work' => 'required|max:1000',
                'note' => 'max:1000',
                'quantity_of_work' => 'required|numeric|max:10000000',
                'converted_standard_time' => 'required|numeric|max:10000000',
                'converted_time' => 'required|numeric|max:10000000',
                'session_id'=> 'required_if:session_new,==,0',
                'session_new'=> 'required',
                'start_year'=> 'required_if:session_new,==,1|integer|nullable|unique:workloadsessions,start_year',
                'end_year'=>    [
                                    'required_if:session_new,==,1',
                                    'digits:4',
                                    'integer',
                                    'nullable',
                                    function ($attribute, $value, $fail) use ($value_start_year) {
                                        $value_end_year = (int)$value;

                                        if ($value_end_year - $value_start_year != 1) {
                                            $fail('Năm kết thúc phải lớn hơn năm bắt đầu 1 năm');
                                        }
                                    }
                                ],

            ],
            [
                'name_of_work.required'=> 'Tên công việc không được bỏ trống',
                'detail_of_work.required'=> 'Chi tiết công việc không được bỏ trống',
                'explain_of_work.required'=> 'Diễn giải công việc không được bỏ trống',
                'unit_of_work.required'=> 'Đơn vị không được bỏ trống',
                'name_of_work.max'=> 'Tên công việc chỉ được chứa 1000 ký tự',
                'detail_of_work.max'=> 'Chi tiết công việc chỉ được chứa 1000 ký tự',
                'explain_of_work.max'=> 'Diễn giải công việc chỉ được chứa 1000 ký tự',
                'unit_of_work.max'=> 'Đơn vị chỉ được chứa 1000 ký tự',
                'note.max'=> 'Ghi chú chỉ được chứa 1000 ký tự',
                'quantity_of_work.required'=> 'Số lượng không được bỏ trống',
                'converted_standard_time.required'=> 'Quy đổi giờ chuẩn không được bỏ trống',
                'converted_time.required'=> 'Số tiết/giờ quy đổi không được bỏ trống',
                'quantity_of_work.numeric'=> 'Số lượng chỉ được nhập số',
                'converted_standard_time.numeric'=> 'Quy đổi giờ chuẩn chỉ được nhập số',
                'converted_time.numeric'=> 'Số tiết/giờ quy đổi chỉ được nhập số',
                'quantity_of_work.max'=> 'Số lượng không hợp lệ',
                'converted_standard_time.max'=> 'Quy đổi giờ chuẩn không hợp lệ',
                'converted_time.max'=> 'Số tiết/giờ quy đổi không hợp lệ',
                'session_id.required_if' =>'Năm học không được bỏ trống',
                'session_new.required' =>'Năm học không được bỏ trống',
                'start_year.required_if' =>'Năm học bắt đầu không được bỏ trống',
                'end_year.required_if' =>'Năm học kết thúc không được bỏ trống',
                'start_year.integer' =>'Năm học bắt đầu phải là số nguyên',
                'start_year.unique' =>'Năm học bắt đầu đã tồn tại trong danh sách',
                'end_year.integer' =>'Năm học kết thúc phải số nguyên',
                'end_year.digits'=> 'Năm học kết thúc phải đúng 4 ký tự',
            ]
                        );
        $srworkload = ScientificResearchWorkload::findOrFail($id_srworkload);
        $pp = strtoupper($request->employee_code);
        $pi = PI::where('employee_code', $pp)->firstOrFail();
        $srworkload->personalinformation_id = $pi->id;
        if ($request->session_new == 0) {
            $srworkload->session_id= $request->session_id;
        } else {
            $workload_session = new WorkloadSession();
            $workload_session->start_year = $request->start_year;
            $workload_session->end_year = $request->end_year;
            $workload_session->save();
            $srworkload->session_id = $workload_session->id;
        }
        $srworkload->name_of_work = $request->name_of_work;
        $srworkload->detail_of_work = $request->detail_of_work;
        $srworkload->explain_of_work = $request->explain_of_work;
        $srworkload->unit_of_work = $request->unit_of_work;
        $srworkload->quantity_of_work = $request->quantity_of_work;
        $srworkload->converted_standard_time = $request->converted_standard_time;
        $srworkload->converted_time = $request->converted_time;
        $srworkload->note = $request->note;
        $srworkload->save();

        return redirect()->back()->with('message', 'Cập nhật thành công');

    }

    public function delete($id_srworkload)
    {
        $this->authorize('cud', PI::firstOrFail());
        $srworkload = ScientificResearchWorkload::findOrFail($id_srworkload);
        $srworkload->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }


}
