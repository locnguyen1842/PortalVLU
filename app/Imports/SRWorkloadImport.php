<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\ScientificResearchWorkload;
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

class SRWorkloadImport implements ToCollection
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

            'name_of_work',
            'detail_of_work',
            'explain_of_work',
            'unit_of_work',
            'quantity_of_work',
            'converted_standard_time',
            'converted_time',
            'note',
            'session_id',
        ];
        //skip to row have required value in excel file
        $array = array_slice($rows->toArray(), 6);
        $change_index_data = array();
        $changed_index_data = array();

        foreach ($array as $key => $value) {
            if(implode(null,$array[$key])==null){
                unset($array[$key]);
            }else{
                // remove useless value
                unset($array[$key][0]);
                unset($array[$key][2]);
                array_push($array[$key], $this->session_id);

                $change_index_data = array_combine(range(1, count($array[$key])), $array[$key]);
                array_push($changed_index_data, $change_index_data);
            }



        }





        $data_to_validate=array_combine(range(7, count($changed_index_data)+6), $changed_index_data);
        //validate
        // dd($data_to_validate);
        Validator::make(
            $data_to_validate,
            [
            '*.1'=>'required|exists:personalinformations,employee_code',
            '*.2'=>'required',
            '*.3' => 'required',
            '*.4'=>'required',
            '*.5' => 'required',
            '*.6'=>'required|numeric',
            '*.7' => 'required|numeric',
            '*.8'=>'required|numeric',

          ],
            [


            '*.1.required' => 'Mã GV không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.1.exists' => 'Mã GV không tồn tại ( vị trí: :attribute|sheet :1 ) ',
            '*.2.required'=>'Công việc không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.3.required' => 'Chi tiết không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.4.required'=>'Diễn giải không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.5.required' => 'Đơn vị không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.6.required'=>'Sô lượng không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.6.numeric' => 'Số lượng chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.7.required' => 'Quy đổi giờ chuẩn không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.7.numeric' => 'Quy đổi giờ chuẩn chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',
            '*.8.required'=>'Số tiết/giờ quy đổi không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
            '*.8.numeric'=>'Số tiết/giờ quy đổi chỉ được nhập số ( vị trí: :attribute|sheet :1 ) ',

          ]
          )->validate();

        if ($this->append == 0) {
            ScientificResearchWorkload::where('session_id', $this->session_id)->delete();
        }
        foreach ($array as $row) {

            $personalinformation_id = PI::where('employee_code', $row[1])->first()->id;

            $replacement = [1 =>$personalinformation_id];
            $data = array_replace($row, $replacement);

            $insert[] = array_combine($excel_header, $data);

        }
        DB::table('scientific_research_workloads')->insert($insert);
    }
}
