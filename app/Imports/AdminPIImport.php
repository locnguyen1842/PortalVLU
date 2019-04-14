<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;

class AdminPIImport implements WithMultipleSheets
{
    use Importable;
  public function sheets(): array
  {
      return [
            // Select by sheet index
            0 => new PIImport,

            // Select by sheet name
            1 => new DegreeDetailImport,
            2 => new AcademicRankImport,
            3 => new AddressImport,
      ];
  }
}
