<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        return view('admin.statistic.index');
    }
    public function industry(){
        return view('admin.statistic.industry');

    }
}
