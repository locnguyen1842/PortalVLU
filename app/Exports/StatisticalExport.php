<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\PI;
use App\Officer;
use App\Teacher;

class StatisticalExport implements FromView
{

    public function view(): View
    {
        libxml_use_internal_errors(TRUE);
        return view('admin.statistic.download', [
            'pis' => PI::where('show',1)->get(),
            'officers' => Officer::whereHas('pi',function($q){
                $q->where('show',1);
            })->get(),
            'teachers' => Teacher::whereHas('pi',function($q){
                $q->where('show',1);
            })->get()
        ]);
        libxml_use_internal_errors(FALSE);
    }
}
