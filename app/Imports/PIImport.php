<?php

namespace App\Imports;

use App\PI;
use App\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
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

        foreach ($rows as $row)
        {
          $split = explode(" ",$row[1]);
          $first_name =$split[sizeof($split)-1];
          $pi = PI::updateOrCreate([
            'employee_code' => $row[0],
            'full_name' => $row[1],
            'first_name' => $first_name,
            'nation' => $row[2],
            'gender' => $row[3] == 'Nam' ? 0:1,
            'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]),
            'place_of_birth' => $row[5],
            'permanent_address' => $row[6],
            'contact_address' => $row[7],
            'identity_card' => $row[8],
            'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
            'place_of_issue' => $row[10],
            'phone_number' => $row[11],
            'email_address' => $row[12],
            'date_of_recruitment' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]),
            'position' =>$row[14],
            'professional_title' => $row[15],
            'show' => 1,
          ]);

          $employee = Employee::updateOrCreate([
            'username' => $pi->employee_code,
            'personalinformation_id'=> $pi->id,
            'email' => $pi->email_address,
            'password' => Hash::make($pi->password),
          ]);
        }

    }

}
