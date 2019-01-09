<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Workload;
use App\WorkloadSession;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use App\PI;
use App\Unit;

class WorkloadImport implements ToCollection
{


    // public function startRow():int {
    //     return 8;
    // }

    // public function mapping(): array
    // {
    //     return [
    //         'personalinformation_id' => 'B6',
    //         'subject_code' => 'F6',
    //         'subject_name' => 'G6',
    //         'number_of_lessons' => 'H6',
    //         'class_code' => 'I6',
    //         'number_of_students' => 'J6',
    //         'total_workload' => 'K6',
    //         'theoretical_hours' => 'L6',
    //         'practice_hours' => 'M6',
    //         'note' => 'N6',
    //         'unit_id' => 'O6',
    //         'semester' => 'P6',
    //         'session_year' => 'B3'
    //     ];
    // }

    /**
    * @param Collection $collection
    */

    public function collection(Collection $rows)
    {
        // dd($rows);
        // handle session of workload : rows[2][1] contain value for workload session
        $session_string = $rows[2][1];
        $session_year = preg_replace('/[^0-9]/', '', $session_string);
        $session_year_array = str_split($session_year,4);

        $workload_session = WorkloadSession::where('start_year',$session_year_array[0])->where('end_year',$session_year_array[1])->first();
        if($workload_session->exists()){
            $session_id = $workload_session->id;
        }else{
            $session = WorkloadSession::create([
                'start_year' => $session_year_array[0],
                'end_year' => $session_year_array[1]
            ]);

            $session_id = $session->id;
        }
        //validate rule:in unit_code
        $units = Unit::all();
        $units_code = [];
        foreach ($units as $unit) {
          array_push($units_code,$unit->unit_code );
        }
        //skip to row have required value in excel file
        $array = array_slice($rows->toArray(),7);
        $change_index_data = array();
        $changed_index_data = array();
        foreach ($array as $key => $value) {
          $change_index_data = array_combine(range(1, count($array[$key])), $array[$key]);
          array_push($changed_index_data,$change_index_data);
        }

        $data_to_validate=array_combine(range(8, count($changed_index_data)+7), $changed_index_data);
        //validate
        Validator::make($data_to_validate, [
            '*.2'=>'required|exists:personalinformations,employee_code',
            '*.6'=>'required',
            '*.7' => 'required',
            '*.8'=>'required|numeric',
            '*.9' => 'required',
            '*.10'=>'required|integer',
            '*.11' => 'required|numeric',
            '*.12'=>'required|numeric',
            '*.13' => 'required|numeric',
            '*.15' =>   [
                            'required',
                            Rule::in($units_code),
                        ],
            '*.16'=>'required|integer',

          ],[


            '*.2.required' => 'Mã GV không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.2.exists' => 'Mã GV không tồn tại ( vị trí: :attribute|sheet :1 ) ',
            '*.6.required'=>'Mã HP không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.7.required' => 'Học phần giảng dạy không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.8.required'=>'Số tiết/giờ không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.8.numeric'=>'Số tiết/giờ chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.9.required' => 'Lớp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.10.required'=>'Số SV không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.10.integer' => 'Số SV chỉ được nhập số nguyên ( vị trí: :attribute|sheet :1 ) ',
            '*.11.required' => 'Quy đổi giờ chuẩn không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.11.numeric' => 'Quy đổi giờ chuẩn chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.12.required'=>'Số giờ LT không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.12.numeric'=>'Số giờ LT chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.13.required'=>'Số giờ TH không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.13.numeric'=>'Số giờ TH chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.13.required' => 'Email không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.13.email' => 'Email không đúng định dạng ( vị trí: :attribute|sheet :1 ) ',
            '*.15.required' => 'Mã khoa không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.15.in' => 'Mã Khoa không tồn tại ( vị trí: :attribute|sheet :1 )',
            '*.16.required'=>'Học kỳ không được bỏ trống ( vị trí: :attribute|sheet :1 )',
            '*.16.integer'=>'Học kỳ chỉ được nhập số nguyên. ( vị trí: :attribute|sheet :1 )',
          ]
          )->validate();

        foreach($array as $row){
            if($this->isExistsPI($row[1])){
                $pi = $this->getPIbyEmployeeCode($row[1]);
            }
            if($this->isExistsUnit($row[14])){
                $unit = $this->getUnitbyUnitCode($row[14]);
            }
            $workloads = Workload::create(
                [
                    'personalinformation_id' => $pi->id,
                    'subject_code'           => $row[5],
                    'subject_name'           => $row[6],
                    'number_of_lessons'      => $row[7],
                    'class_code'             => $row[8],
                    'number_of_students'     => $row[9],
                    'total_workload'         => $row[10],
                    'theoretical_hours'      => $row[11],
                    'practice_hours'         => $row[12],
                    'note'                   => $row[13],
                    'unit_id'                => $unit->id,
                    'semester'               => $row[15],
                    'session_id'             => $session_id,
                ]
            );
        }
    }

    public function isExistsPI($employee_code){
        if(PI::where('employee_code',$employee_code)->exists()){
            return true;
        }else{
            return false;
        }
    }

    public function getPIbyEmployeeCode($employee_code){
        return PI::where('employee_code',$employee_code)->first();
    }

    public function isExistsUnit($unit_code){
        if(Unit::where('unit_code',$unit_code)->exists()){
            return true;
        }else{
            return false;
        }
    }

    public function getUnitbyUnitCode($unit_code){
        return Unit::where('unit_code',$unit_code)->first();
    }
}
