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

class WorkloadImport implements ToCollection
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
        $start =Carbon::now();
        set_time_limit(0);
        // handle session of workload : rows[2][1] contain value for workload session
        //validate rule:in unit_code
        $units = Unit::all();
        $units_code = [];
        foreach ($units as $unit) {
            array_push($units_code, $unit->unit_code);
        }
        //skip to row have required value in excel file
        $array = array_slice($rows->toArray(), 7);
        $change_index_data = array();
        $changed_index_data = array();
        foreach ($array as $key => $value) {
            $change_index_data = array_combine(range(1, count($array[$key])), $array[$key]);
            array_push($changed_index_data, $change_index_data);
        }

        $data_to_validate=array_combine(range(8, count($changed_index_data)+7), $changed_index_data);
        //validate

        Validator::make(
            $data_to_validate,
            [
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

          ],
            [


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

        if ($this->append == 0) {
            Workload::where('session_id', $this->session_id)->delete();
        }
            $workloads = DB::table('workloads');
            foreach ($array as $row) {
                $workloads->insert(
                    [
                        'personalinformation_id' => PI::where('employee_code', $row[1])->first()->id,
                        'subject_code'           => $row[5],
                        'subject_name'           => $row[6],
                        'number_of_lessons'      => $row[7],
                        'class_code'             => $row[8],
                        'number_of_students'     => $row[9],
                        'total_workload'         => $row[10],
                        'theoretical_hours'      => $row[11],
                        'practice_hours'         => $row[12],
                        'note'                   => $row[13],
                        'unit_id'                => Unit::where('unit_code', $row[14])->first()->id,
                        'semester_id'            => Semester::where('alias', $row[15])->first()->id,
                        'session_id'             => $this->session_id,
                    ]
                );
            }
    }
}
