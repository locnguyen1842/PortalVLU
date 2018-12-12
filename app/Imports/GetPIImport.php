<?php

namespace App\Imports;

use App\PI;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;


class GetPIImport implements ToCollection
{
    use Importable;
    public function collection(Collection $rows)
    {
        $arr_pi = array();
        foreach ($rows as $row)
        {
            
        }
    }
}
