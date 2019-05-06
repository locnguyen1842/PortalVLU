<?php

namespace App\Http\Controllers;
use App\PI;
use App\Officer;
use App\Teacher;
use App\AcademicRank;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StatisticalExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatisticController extends Controller
{
    public function index(){
        $pis = PI::where('show',1)->where('is_activity',1)->get();
        $officers = Officer::whereHas('pi',function($q){
            $q->where('show',1)->where('is_activity',1);
        })->get();
        $teachers = Teacher::whereHas('pi',function($q){
            $q->where('show',1)->where('is_activity',1);
        })->get();
        return view('admin.statistic.index',compact('pis','officers','teachers'));
    }
    public function download(){

        return (new StatisticalExport)->download('thongke.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }
}
