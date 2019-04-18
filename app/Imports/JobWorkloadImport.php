<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Workload;
use App\WorkloadSession;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Facades\DB;
use App\PI;
use App\Unit;
use App\Semester;
use Carbon\Carbon;

class JobWorkloadImport implements ToCollection
{
    use Importable;
    protected $append= null;
    protected $session_id= null;
    public function __construct($append, $session_id)
    {
        $this->append = $append;
        $this->session_id = $session_id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        set_time_limit(200);
        // handle session of workload : rows[2][1] contain value for workload session
        //validate rule:in unit_code
        $units = Unit::all();
        $units_code = [];
        foreach ($units as $unit) {
            array_push($units_code, $unit->unit_code);
        }
        $excel_header = [
            'personalinformation_id',
            'subject_code',
            'subject_name',
            'number_of_lessons',
            'class_code',
            'number_of_students',
            'total_workload',
            'theoretical_hours',
            'practice_hours',
            'note',
            'unit_id',
            'semester_id',
            'session_id'
        ];
        //skip to row have required value in excel file
        $array = array_slice($rows->toArray(), 7);
        $change_index_data = array();
        $changed_index_data = array();


        foreach ($array as $key => $value) {
            if(implode(null,$array[$key])==null){
                unset($array[$key]);
            }else{
                // remove useless value
                unset($array[$key][0]);
                unset($array[$key][2]);
                unset($array[$key][3]);
                unset($array[$key][4]);
                array_push($array[$key], $this->session_id);

                $change_index_data = array_combine(range(1, count($array[$key])), $array[$key]);
                array_push($changed_index_data, $change_index_data);
            }



        }





        $data_to_validate=array_combine(range(8, count($changed_index_data)+7), $changed_index_data);
        //validate

        Validator::make(
            $data_to_validate,
            [
            '*.1'=>'required|exists:personalinformations,employee_code',
            '*.2'=>'required',
            '*.3' => 'required',
            '*.4'=>'required|numeric',
            '*.5' => 'required',
            '*.6'=>'required|integer',
            '*.7' => 'required|numeric',
            '*.8'=>'required|numeric',
            '*.9' => 'required|numeric',
            '*.11' =>   [
                            'required',
                            Rule::in($units_code),
                        ],
            '*.12'=>'required|integer',

          ],
            [


            '*.1.required' => 'Mã GV không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.1.exists' => 'Mã GV không tồn tại ( vị trí: :attribute|sheet :1 ) ',
            '*.2.required'=>'Mã HP không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.3.required' => 'Học phần giảng dạy không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.4.required'=>'Số tiết/giờ không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.4.numeric'=>'Số tiết/giờ chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.5.required' => 'Lớp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.6.required'=>'Số SV không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.6.integer' => 'Số SV chỉ được nhập số nguyên ( vị trí: :attribute|sheet :1 ) ',
            '*.7.required' => 'Quy đổi giờ chuẩn không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.7.numeric' => 'Quy đổi giờ chuẩn chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.8.required'=>'Số giờ LT không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.8.numeric'=>'Số giờ LT chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.9.required'=>'Số giờ TH không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.9.numeric'=>'Số giờ TH chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.11.required' => 'Mã khoa không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.11.in' => 'Mã Khoa không tồn tại ( vị trí: :attribute|sheet :1 )',
            '*.12.required'=>'Học kỳ không được bỏ trống ( vị trí: :attribute|sheet :1 )',
            '*.12.integer'=>'Học kỳ chỉ được nhập số nguyên. ( vị trí: :attribute|sheet :1 )',
          ]
          )->validate();

        if ($this->append == 0) {
            Workload::where('session_id', $this->session_id)->delete();
        }
        foreach ($array as $row) {

            $personalinformation_id = PI::where('employee_code', $row[1])->first()->id;
            $unit_id = Unit::where('unit_code', $row[14])->first()->id;
            $semester_id =Semester::where('alias', $row[15])->first()->id;
            $replacement = [1 =>$personalinformation_id,14=>$unit_id,15=>$semester_id];
            $data = array_replace($row, $replacement);


            $insert[] = array_combine($excel_header, $data);
        }
        DB::table('workloads')->insert($insert);
    }
}
