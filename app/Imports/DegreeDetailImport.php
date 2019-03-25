<?php

namespace App\Imports;

use App\Degree;
use App\Industry;
use App\DegreeDetail;
use App\PI;
use App\Country;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DegreeDetailImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        //Rule data for loai bang
        $degrees = Degree::all();
        $degrees_name = array();
        foreach ($degrees as $item) {
            array_push($degrees_name, strtolower($item->name));
        }
        //Rule data for chuyen ngahnh
        $countries = Country::all();
        $countries_code = array();
        foreach ($countries as $item) {
            array_push($countries_code, strtolower($item->country_code));
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

        Validator::make(
          $data_to_validate,
          [
        '*.1' => 'nullable|exists:personalinformations,employee_code',
        '*.2'=>[
                  'required',
                  Rule::in($degrees_name),
               ],
        '*.3'=>[
                  'required',
               ],
        '*.4' => 'required|date',
        '*.5'=>'required',
        '*.6'=> [
                    'required',
                    Rule::in($countries_code),
                ],
        '*.7' => [
                    'required',
                    Rule::in($industries_name),
                 ],
        '*.8'=>'required',

      ],
          [

        '*.1.required' => 'Mã nhân viên không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.1.exists' => 'Mã nhân viên không tồn tại ( vị trí: :attribute|sheet :2 )',
        '*.2.required'=>'Trình độ không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.2.in' => 'Trình độ không hợp lệ. Chỉ được nhập : '.implode(", ", $degrees_name).' ( vị trí: :attribute|sheet :2 )',
        '*.3.required'=>'Chuyên ngành không được bỏ trống ( vị trí: :attribute|sheet :2 )',

        '*.4.required' => 'Ngày cấp bằng không được bỏ trống ( vị trí::attribute|sheet :2 )',
        '*.4.date' => 'Ngày cấp bằng không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :2 )',
        '*.5.required'=>'Nơi cấp bằng không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.6.required' => 'Nước cấp bằng không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.6.in' => 'Nước cấp bằng không hợp lệ ( vị trí: :attribute|sheet :2 )',
        '*.7.required' => 'Khối ngành không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.7.in' => 'Khối ngành không hợp lệ. Chỉ được nhập : '.implode(", ", $industries_name).' ( vị trí: :attribute|sheet :2 )',
        '*.8.required' => 'Học vị không được bỏ trống ( vị trí: :attribute|sheet :2 )',

      ]
      )->validate();
        // dd($rows);
        foreach ($rows as $row) {
            if (empty($row[0])) {
                return null;
            };
            $row = array_map('trim',$row->toArray());
            $row[5] = strtoupper($row[5]);

            $pi_id = PI::where('employee_code', $row[0])->first()->id;
            $degree_id = Degree::where('name', 'like', '%'.$row[1].'%')->first()->id;
            $nation_of_issue_id = Country::where('country_code',$row[5])->first()->id;
            $industry_id = Industry::where('name', 'like', '%'.$row[6].'%')->first()->id;

            DegreeDetail::updateOrCreate(
          [
            'personalinformation_id' => $pi_id,
            'degree_id' => $degree_id,
            'specialized' => $row[2],
            'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            'place_of_issue' => $row[4],
            'nation_of_issue_id' => $nation_of_issue_id,
            'industry_id' => $industry_id,
            'degree_type' => $row[7],

          ],
          [
            'personalinformation_id' => $pi_id,
            'degree_id' => $degree_id,
            'specialized' => $row[2],
            'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            'place_of_issue' => $row[4],
            'nation_of_issue_id' => $nation_of_issue_id,
            'industry_id' => $industry_id,
            'degree_type' => $row[7],
          ]
        );
        }
    }
    public function startRow():int
    {
        return 2;
    }
}
