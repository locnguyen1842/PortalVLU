<?php

namespace App\Imports;

use App\AcademicRankType;
use App\AcademicRank;
use App\Industry;
use App\PI;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AcademicRankImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        //Rule data for hoc ham
        $academic_rank_types = AcademicRankType::all();
        $academic_rank_types_name = array();
        foreach ($academic_rank_types as $item) {
            array_push($academic_rank_types_name, strtolower($item->name));
        }

        //Rule data for  Khoi Nghanh
        $industries = Industry::all();
        $industries_name = array();
        foreach ($industries as $item) {
            array_push($industries_name, strtolower($item->name));
        }
        $data = $rows->toArray();
        $change_index_data = array();
        $changed_index_data = array();
        foreach ($data as $key => $value) {
            $change_index_data = array_combine(range(1, count($data[$key])), $data[$key]);
            array_push($changed_index_data, $change_index_data);
        }

        $data_to_validate=array_combine(range(2, count($changed_index_data)+1), $changed_index_data);
        foreach ($data_to_validate as &$item) {
            $item = array_map('trim', $item);
            $item = array_map('strtolower', $item);
            $item[4] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[4]);
        }
        //   dd($countries_code);
        // dd($data_to_validate);

        Validator::make(
          $data_to_validate,
          [
        '*.1' => 'nullable|exists:personalinformations,employee_code',
        '*.2'=>[
                  'required',
                  Rule::in($academic_rank_types_name),
               ],
        '*.3'=>[
                  'required',
               ],
        '*.4' => 'required|date',
        '*.5' => [
                    'required',
                    Rule::in($industries_name),
                 ],

      ],
          [

        '*.1.required' => 'Mã nhân viên không được bỏ trống ( vị trí: :attribute|sheet :3 )',
        '*.1.exists' => 'Mã nhân viên không tồn tại ( vị trí: :attribute|sheet :3 )',
        '*.2.required'=>'Học hàm không được bỏ trống ( vị trí: :attribute|sheet :3 )',
        '*.2.in' => 'Học hàm không hợp lệ. Chỉ được nhập : '.implode(", ", $academic_rank_types_name).' ( vị trí: :attribute|sheet :3 )',
        '*.3.required'=>'Chuyên ngành không được bỏ trống ( vị trí: :attribute|sheet :3 )',

        '*.4.required' => 'Ngày công nhận không được bỏ trống ( vị trí::attribute|sheet :3 )',
        '*.4.date' => 'Ngày công nhận không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :3 )',
        '*.5.required' => 'Khối ngành không được bỏ trống ( vị trí: :attribute|sheet :3 )',
        '*.5.in' => 'Khối ngành không hợp lệ. Chỉ được nhập : '.implode(", ", $industries_name).' ( vị trí: :attribute|sheet :3 )',

      ]
      )->validate();
        // dd($rows);
        foreach ($rows as $row) {
            if (empty($row[0])) {
                return null;
            };
            $row = array_map('trim', $row->toArray());

            $pi_id = PI::where('employee_code', $row[0])->first()->id;
            $type_id = AcademicRankType::where('name', 'like', '%'.$row[1].'%')->first()->id;
            $industry_id = Industry::where('name', 'like', '%'.$row[4].'%')->first()->id;

            AcademicRank::updateOrCreate(
          [
            'personalinformation_id' => $pi_id,
            'type_id' => $type_id,
            'specialized' => $row[2],
            'date_of_recognition' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            'industry_id' => $industry_id,

          ],
          [
            'personalinformation_id' => $pi_id,
            'type_id' => $type_id,
            'specialized' => $row[2],
            'date_of_recognition' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            'industry_id' => $industry_id,
          ]
        );
        }
    }
    public function startRow():int
    {
        return 2;
    }
}
