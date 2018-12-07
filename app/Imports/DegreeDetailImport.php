<?php

namespace App\Imports;

use App\Degree;
use App\Industry;
use App\DegreeDetail;
use App\PI;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DegreeDetailImport implements ToCollection,WithStartRow
{
  public function collection(Collection $rows)
  {

      foreach ($rows as $row)
      {
        $pi_id = PI::where('employee_code',$row[0])->first()->id;
        $degree_id = Degree::where('name','like','%'.$row[1].'%')->first()->id;
        $industry_id = Industry::where('name','like','%'.$row[4].'%')->first()->id;
        DegreeDetail::updateOrCreate([
          'date_of_issue' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
          'place_of_issue' => $row[3],
          'degree_id' => $degree_id,
          'personalinformation_id' => $pi_id,
          'industry_id' => $industry_id,
        ]);

      }
  }
  public function startRow():int {
    return 2;
  }
}
