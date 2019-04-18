<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;

class AdminWorkloadImport implements WithMultipleSheets
{
    use Importable;
    protected $append= null;
    protected $session_id= null;
    public function __construct($append, $session_id)
    {
        $this->append = $append;
        $this->session_id = $session_id;
    }
    public function sheets(): array
    {
        return [
                0 => new JobWorkloadImport($this->append,$this->session_id),
                1 => new SRWorkloadImport($this->append,$this->session_id),

        ];
    }
}
