<?php

namespace App\Imports;

use App\Degree;
use App\Industry;
use App\DegreeDetail;
use App\PI;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class DegreeDetailImport implements ToCollection,WithStartRow
{
  public function collection(Collection $rows)
  {
      //Rule data for loai bang
      $degrees = Degree::all();
      $degrees_name = array();
      foreach ($degrees as $item) {
        array_push($degrees_name,$item->name);
      }

      //Rule data for  Khoi Nghanh
      $industries = Industry::all();
      $industries_name = array();
      foreach ($industries as $item) {
        array_push($industries_name,$item->name);
      }
      $data = $rows->toArray();
      $change_index_data = array();
      $changed_index_data = array();
      foreach ($data as $key => $value) {
        $change_index_data = array_combine(range(1, count($data[$key])), $data[$key]);
        array_push($changed_index_data,$change_index_data);
      }

      $data_to_validate=array_combine(range(2, count($changed_index_data)+1), $changed_index_data);
      foreach ($data_to_validate as &$item) {
            $item[3] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[3]);
      }
      Validator::make($data_to_validate, [
        '*.1' => 'nullable|exists:personalinformations,employee_code',
        '*.2'=>[
                  'required_with:*.1',
                  Rule::in($degrees_name),
               ],
        '*.3' => 'required_with:*.1|date',
        '*.4'=>'required_with:*.1',
        '*.5' => [
                    'required_with:*.1',
                    Rule::in($industries_name),
                 ],

      ],[

        '*.1.required' => 'Mã nhân viên không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.1.exists' => 'Mã nhân viên không tồn tại ( vị trí: :attribute|sheet :2 )',
        '*.2.required_with'=>'Loại bằng không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.2.in' => 'Loại bằng không hợp lệ .Chỉ được nhập : '.implode(", ",$degrees_name).' ( vị trí: :attribute|sheet :2 )',
        '*.3.required_with' => 'Ngày cấp bằng không được bỏ trống ( vị trí::attribute|sheet :2 )',
        '*.3.date' => 'Ngày cấp bằng không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :2 )',
        '*.4.required_with'=>'Nơi cấp bằng không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.5.required_with' => 'Khối nghành không được bỏ trống ( vị trí: :attribute|sheet :2 )',
        '*.5.in' => 'Khối nghành không hợp lệ .Chỉ được nhập : '.implode(", ",$industries_name).' ( vị trí: :attribute|sheet :2 )',
      ]
      )->validate();
      foreach ($rows as $row)
      {
        if(empty($row[0])){
          return null;
        };

        $pi_id = PI::where('employee_code',$row[0])->first()->id;
        $degree_id = Degree::where('name','like','%'.$row[1].'%')->first()->id;
        $industry_id = Industry::where('name','like','%'.$row[4].'%')->first()->id;

        DegreeDetail::updateOrCreate(
          [
            'personalinformation_id' => $pi_id,
            'degree_id' => $degree_id,
            'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
            'place_of_issue' => $row[3],
            'industry_id' => $industry_id,
          ],
          [
            'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
            'place_of_issue' => $row[3],
            'degree_id' => $degree_id,
            'personalinformation_id' => $pi_id,
            'industry_id' => $industry_id,
          ]
        );

      }
  }
  public function startRow():int {
    return 2;
  }
}
