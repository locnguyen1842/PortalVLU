<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\PI;
use App\Officer;
use App\Teacher;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class StatisticalExport implements FromView,WithColumnFormatting,WithEvents
{
    use Exportable;
    public function view(): View
    {
        return view('admin.statistic.download', [
            'pis' => PI::where('show',1)->get(),
            'officers' => Officer::whereHas('pi',function($q){
                $q->where('show',1)->where('is_activity',1);
            })->get(),
            'teachers' => Teacher::whereHas('pi',function($q){
                $q->where('show',1)->where('is_activity',1);
            })->get()
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRangeHeader = 'A1:K4'; // All headers
                $cellRangeSta = 'C1:K80'; // All headers
                $event->sheet->getDelegate()
                ->getStyle($cellRangeHeader)
                ->getAlignment()
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setWrapText(true);
                $event->sheet->getDelegate()
                ->getStyle($cellRangeSta)
                ->getAlignment()
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setWrapText(true);
                $event->sheet->getDelegate()
                ->getColumnDimension('B')
                ->setAutoSize(true);

            },
        ];
    }
}
