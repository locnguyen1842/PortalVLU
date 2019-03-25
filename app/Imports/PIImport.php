<?php

namespace App\Imports;

use App\PI;
use App\Employee;
use App\Address;
use App\Nation;
use App\Unit;
use App\Ward;
use App\District;
use App\Province;
use App\OfficerType;
use App\PositionType;
use App\Officer;
use App\AcademicRankType;
use App\AcademicRank;
use App\Teacher;
use App\TeacherTitle;
use App\TeacherType;
use App\ScientificBackground;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Hash;
use Carbon\Carbon;

class PIImport implements ToCollection, WithStartRow
{
    public function startRow():int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        set_time_limit(200);
        //get nation
        $nations = Nation::all();
        $nations_name = [];
        foreach ($nations as $nation) {
            array_push($nations_name, strtolower($nation->name));
        }

        $units = Unit::all();
        $units_name = [];
        foreach ($units as $unit) {
            array_push($units_name, strtolower($unit->name));
        }

        $officer_types = OfficerType::all();
        $officer_types_name = [];
        foreach ($officer_types as $type) {
            array_push($officer_types_name, strtolower($type->name));
        }

        // dd($officer_types_name);
        $position_types = PositionType::all();
        $position_types_name = [];
        foreach ($position_types as $type) {
            array_push($position_types_name, strtolower($type->name));
        }

        $academic_rank_types = AcademicRankType::all();
        $academic_rank_types_name = [];
        foreach ($academic_rank_types as $type) {
            array_push($academic_rank_types_name, strtolower($type->name));
        }

        $teacher_titles = TeacherTitle::all();
        $teacher_titles_name = [];
        foreach ($teacher_titles as $title) {
            array_push($teacher_titles_name, strtolower($title->name));
        }

        $teacher_types = TeacherType::all();
        $teacher_types_name = [];
        foreach ($teacher_types as $type) {
            array_push($teacher_types_name, strtolower($type->name));
        }

        //xu ly thay doi index cho array
        $data = $rows->toArray();
        $change_index_data = array();
        $changed_index_data = array();
        foreach ($data as $key => $value) {
            $change_index_data = array_combine(range(1, count($data[$key])), $data[$key]);
            array_push($changed_index_data, $change_index_data);
        }

        $data_to_validate=array_combine(range(2, count($changed_index_data)+1), $changed_index_data);



        foreach ($data_to_validate as &$item) {
            $item = array_map('trim',$item);
            $item = array_map('strtolower',$item);

            // ngay sinh
            $item[5] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[5]);

            // ngay cap cmnd
            $item[9] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[9]);
            // ngay tuyen dung

            $item[13] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[13]);
            // ngay nghi huu

            if ($item[22] == 'x') {
                $item[22] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[22]);

            } else {
                $item[22] = '';


            }

        }
        // dd($teacher_types_name);
        //validate data da thay doi index
        Validator::make(
            $data_to_validate,
            [
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3'=> [
                        'required',
                        Rule::in($nations_name),
                    ],

            '*.4'=> [
                        'required',
                        Rule::in(['nam','nữ']),
                    ],
            '*.5' => 'required|date',
            '*.6'=>'required',
            '*.7' => 'required',
            '*.8'=>'required',
            '*.9' => 'required|date',
            '*.10'=>'required',
            '*.11' => 'required',
            '*.12'=>'email|required',
            '*.13' => 'required|date',
            //   '*.14'=>'required', professional title
            '*.14' => 'required',
            '*.15'=>    [
                            'required',
                            Rule::in($units_name),
                        ],
            '*.16'=>    [
                            'nullable',
                            Rule::in($officer_types_name),
                        ],
            '*.17'=>    [
                            'nullable',
                            Rule::in($position_types_name),
                        ],
            '*.18'=> 'nullable',
            '*.19'=>    [
                            'nullable',
                            Rule::in($teacher_types_name),
                        ],
            '*.20'=>    [
                            'nullable',
                            Rule::in($teacher_titles_name),
                        ],
            '*.21'=>    'nullable',
            '*.22'=>    'nullable',

            '*.23'=> 'nullable',
            '*.24'=> 'nullable',
            '*.25'=> 'nullable',

        ],
            [

          '*.1.required' => 'Mã nhân viên không được bỏ trống ( vị trí: :attribute|sheet :1 )',
          '*.2.required' => 'Họ tên không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.3.required'=>'Dân tộc không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.3.in'=>'Dân tộc không hợp lệ. ( vị trí: :attribute|sheet :1 ) ',
          '*.4.required'=>'Giới tính không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.4.in'=>'Giới tính không hợp lệ. Chỉ được nhập : Nam , Nữ ( vị trí: :attribute|sheet :1 ) ',
          '*.5.required' => 'Ngày sinh không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.5.date' => 'Ngày sinh không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :1 ) ',
          '*.6.required'=>'Nơi sinh không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.7.required' => 'Quê quán không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.8.required'=>'CMND không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.9.required'=>'Ngày cấp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.9.date' => 'Ngày cấp không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :1 ) ',
          '*.10.required' => 'Nơi cấp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.11.required'=>'Số điện thoại không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.12.required' => 'Email không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.12.email' => 'Email không đúng định dạng ( vị trí: :attribute|sheet :1 ) ',
          '*.13.required'=>'Ngày tuyển dụng không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.13.date' => 'Ngày tuyển dụng không đúng định dạng ngày tháng ( vị trí: :attribute|sheet :1 ) ',
        //   '*.14.required' => 'Chức vụ không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',

          '*.14.required' => 'Mật khẩu không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.15.required' => 'Đơn vị không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.15.in' => 'Đơn vị không hợp lệ ( vị trí: :attribute|sheet :1 ) ',
        //   '*.16.required' => 'Loại cán bộ không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.16.in' => 'Loại cán bộ không hợp lệ ( vị trí: :attribute|sheet :1 ) ',
        //   '*.17.required' => 'Chức vụ không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.17.in' => 'Chức vụ không hợp lệ ( vị trí: :attribute|sheet :1 ) ',
          '*.18.required' => 'Kiêm nhiệm giảng dạy không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
        //   '*.19.required' => 'Loại giảng viên không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.19.in' => 'Loại giảng viên không hợp lệ ( vị trí: :attribute|sheet :1 ) ',
        //   '*.20.required' => 'Chức danh nghề nghiệp không được bỏ trống ( vị trí: :attribute|sheet :1 ) ',
          '*.20.in' => 'Chức danh nghề nghiệp không hợp lệ ( vị trí: :attribute|sheet :1 ) ',
        //   '*.22.required_if' => 'Ngày nghỉ hưu không hợp lệ ( vị trí: :attribute|sheet :1 ) ',


        ]
        )->validate();
        foreach ($rows as $row) {
            // dd($rows);
            $row = array_map('trim',$row->toArray());

            //split first name

            $split = explode(" ", $row[1]);
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
                    'nation_id' => Nation::where('name', 'like', '%'.$row[2].'%')->first()->id,
                    'gender' => $row[3] == 'nam' ? 0:1,
                    'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]),
                    'place_of_birth' => $row[5],
                    'home_town' => $row[6],
                    'identity_card' => $row[7],
                    'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]),
                    'place_of_issue' => $row[9],
                    'phone_number' =>$row[10],
                    'email_address' => $row[11],
                    'date_of_recruitment' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]),

                    'show' => 1,
                    'new' =>0,
                    'unit_id' => Unit::where('name', 'like', '%'.$row[14].'%')->first()->id,
                    'is_activity' => ($row[24] == 'x') ? 0:1,
                ]
            );

            if($row[15] != null){
                $officer_type_id = OfficerType::where('name','like','%'.$row[15].'%')->first()->id;

            }else{
                $officer_type_id = null ;
            }
            if($row[16] != null){

                $position_type_id = PositionType::where('name','like','%'.$row[16].'%')->first()->id;
            }else{
                $position_type_id = null;
            }
            if($row[15] != null){
                $officer = Officer::updateOrCreate(
                    [
                        'personalinformation_id' => $pi->id,
                    ],
                    [
                        'personalinformation_id' => $pi->id,
                        'type_id' => $officer_type_id,
                        'position_id' => $position_type_id,
                        'is_concurrently' => ($row[17] == 'x') ? 1:0,
                    ]
                );
            }


            if($row[20] == 'x'){
                if($row[21] != null){
                    $date_of_retirement = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21]);
                }else{
                    $date_of_retirement = null;
                }
            }else{
                $date_of_retirement = null;
            }

            if($row[18] != null){
                $teacher_type_id = TeacherType::where('name','like','%'.$row[18].'%')->first()->id;

            }else{
                $teacher_type_id = null;
            }
            if($row[19] != null){

                $teacher_title_id = TeacherTitle::where('name','like','%'.$row[19].'%')->first()->id;
            }else{
                $teacher_title_id = null;
            }
            if($row[18] !=null){
                $teacher = Teacher::updateOrCreate(
                    [
                        'personalinformation_id' => $pi->id,
                    ],
                    [
                        'personalinformation_id' => $pi->id,
                        'type_id' => $teacher_type_id,
                        'title_id' => $teacher_title_id,
                        'is_retired' => ($row[20] == 'x') ? 1:0,
                        'date_of_retirement' => $date_of_retirement,
                        'is_excellent_teacher' => ($row[22] == 'x') ? 1:0,
                        'is_national_teacher' => ($row[23] == 'x') ? 1:0,
                    ]
                );
            }

            //  // 7 8 9 10 => permanent address (address,ward,district,province)
            // $permanent_address = Address::updateOrCreate(
            //     [
            //         'address_content' => $row[7],
            //         'ward_id' => $row[8],
            //         'district_id' => $row[9],
            //         'province_id' => $row[10],
            //     ]
            // );
            // $pi->permanent_address_id = $permanent_address->id;

            // // 11 12 13 14 => contact address (address,ward,district,province)
            // $contact_address = Address::updateOrCreate(
            //     [
            //         'address_content' => $row[11],
            //         'ward_id' => $row[12],
            //         'district_id' => $row[13],
            //         'province_id' => $row[14],
            //     ]
            // );
            // $pi->contact_address_id = $contact_address->id;
            // $pi->save();
            $employee = Employee::updateOrCreate(
                [
                'username' => $pi->employee_code,
                ],
                [
                'username' => $pi->employee_code,
                'personalinformation_id'=> $pi->id,
                'email' => $pi->email_address,
                'password' => Hash::make($row[13]),
                ]
            );
            ScientificBackground::updateOrCreate(
                [
                    'personalinformation_id' => $pi->id,
                ],
                [
                    'personalinformation_id' => $pi->id,
                    'highest_scientific_title' => 'Chưa có',
                    'year_of_appointment' => '',
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
