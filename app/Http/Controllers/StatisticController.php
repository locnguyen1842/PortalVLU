<?php

namespace App\Http\Controllers;
use App\PI;
use App\Officer;
use App\Teacher;
use App\AcademicRank;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        $pis = PI::where('show',1)->get();
        $officers = Officer::all();
        $teachers = Teacher::all();
        $academic_ranks = AcademicRank::all();
        return view('admin.statistic.index',compact('pis','officers','teachers','academic_ranks'));
    }
    public function industry(){
        return view('admin.statistic.industry');

    }
}
