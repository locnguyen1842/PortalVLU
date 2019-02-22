<?php

namespace App\Imports;

use App\PI;
use App\Employee;
use App\Nation;
use App\ScientificBackground;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Hash;
use Carbon\Carbon;
class PIImport implements ToCollection,WithStartRow
{
    public function startRow():int {
      return 2;
    }

    public function collection(Collection $rows)
    {
        set_time_limit(200);
        //get nation
        $nations = Nation::all();
        $nations_name = [];
        foreach ($nations as $nation) {
          array_push($nations_name,$nation->name );
        }

        //xu ly thay doi index cho array
        $data = $rows->toArray();
        $change_index_data = array();
        $changed_index_data = array();
        foreach ($data as $key => $value) {
          $change_index_data = array_combine(range(1, count($data[$key])), $data[$key]);
          array_push($changed_index_data,$change_index_data);
        }

        $data_to_validate=array_combine(range(2, count($changed_index_data)+1), $changed_index_data);
        foreach ($data_to_validate as &$item) {

              $item[5] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[5]);
              $item[10] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[10]);
              $item[14] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[14]);
        }
        //validate data da thay doi index
        Validator::make($data_to_validate, [
          '*.1' => 'required',
          '*.2' => 'required',
          '*.3'=>[
                  'required',
                  Rule::in($nations_name),
                ],

          '*.4'=>[
                  'required',
                  Rule::in(['Nam','Nữ']),
                ],
          '*.5' => 'required|date',
          '*.6'=>'required',
          '*.7' => 'required',
          '*.8'=>'required',
          '*.9' => 'required',
          '*.10'=>'required|date',
          '*.11' => 'required',
          '*.12'=>'required',
          '*.13' => 'email|required',
          '*.14'=>'required|date',
          '*.15' => 'required',
          '*.16'=>'required',
          '*.17' => 'required',

        ],[

          '*.1.required' => 'Mã nhân viên không được bỏ trống ( vị trí: :attribute|sheet :1 )',
          '*.2.required' => 'Họ tên không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.3.required'=>'Dân tộc không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.3.in'=>'Dân tộc không hợp lệ. ( vị trí: :attribute|sheet :1 ) ',
          '*.4.required'=>'Giới tính không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.4.in'=>'Giới tính không hợp lệ. Chỉ được nhập : Nam , Nữ ( vị trí: :attribute|sheet :1 ) ',
          '*.5.required' => 'Ngày sinh không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.5.date' => 'Ngày sinh không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :1 ) ',
          '*.6.required'=>'Nơi sinh không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.7.required' => 'Địa chỉ thường trú không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.8.required'=>'Địa chỉ liên lạc không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.9.required' => 'CMND không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.10.required'=>'Ngày cấp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.10.date' => 'Ngày cấp không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :1 ) ',
          '*.11.required' => 'Nơi cấp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.12.required'=>'Số điện thoại không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.13.required' => 'Email không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.13.email' => 'Email không đúng định dạng ( vị trí: :attribute|sheet :1 ) ',
          '*.14.required'=>'Ngày tuyển dụng không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.14.date' => 'Ngày tuyển dụng không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :1 ) ',
          '*.15.required' => 'Chức vụ không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.16.required'=>'Chức danh chuyên môn không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.17.required' => 'Mật khẩu không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
        ]
        )->validate();

        foreach ($rows as $row)
        {
            //split first name
            $split = explode(" ",$row[1]);
            $first_name =$split[sizeof($split)-1];
            //import to db
            $pi = PI::updateOrCreate(
                [
                    'employee_code' => $row[0],
                ],
                [
                    'employee_code' => $row[0],
                    'full_name' => $row[1],
                    'first_name' => $first_name,
                    'nation_id' => Nation::where('name','like','%'.$row[2].'%')->first()->id,
                    'gender' => $row[3] == 'Nam' ? 0:1,
                    'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]),
                    'place_of_birth' => $row[5],
                    'permanent_address' => $row[6],
                    'contact_address' => $row[7],
                    'identity_card' => $row[8],
                    'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
                    'place_of_issue' => $row[10],
                    'phone_number' =>$row[11],
                    'email_address' => $row[12],
                    'date_of_recruitment' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]),
                    'position' =>$row[14],
                    'professional_title' => $row[15],
                    'show' => 1,
                    'new' =>0,
                    'unit' => $row[17]
                ]
            );

            $employee = Employee::updateOrCreate(
                [
                'username' => $pi->employee_code,
                ],
                [
                'username' => $pi->employee_code,
                'personalinformation_id'=> $pi->id,
                'email' => $pi->email_address,
                'password' => Hash::make($row[16]),
                ]
            );
            ScientificBackground::updateOrCreate(
                [
                    'personalinformation_id' => $pi->id,
                ],
                [
                    'personalinformation_id' => $pi->id,
                    'highest_scientific_title' => 'Chưa có',
                    'year_of_appointment' => 'Chưa có',
                    'address' => $pi->contact_address,
                    'highest_degree' =>'Chưa có',
                    'orga_phone_number' => 'Chưa có',
                    'home_phone_number' => 'Chưa có',
                    'mobile_phone_number' => $pi->phone_number
                ]
            );
        }

    }

}
