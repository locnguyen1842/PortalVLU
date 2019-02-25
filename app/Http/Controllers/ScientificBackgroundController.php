<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nation;
use App\Unit;
use App\SBTopicLevel;

use App\ScientificBackground;
use Auth;

class ScientificBackgroundController extends Controller
{
    public function getdetailAdmin($pi_id){
        $sb = ScientificBackground::where('personalinformation_id',$pi_id)->firstOrFail();
        return view('admin.sb.sb-detail', compact('pi_id','sb'));

    }

    public function getupdateAdmin($pi_id){
        $sb = ScientificBackground::where('personalinformation_id',$pi_id)->firstOrFail();
        $nations = Nation::all();
        $units = Unit::all();
        $topic_levels = SBTopicLevel::all();
        return view('admin.sb.sb-update',compact('pi_id','sb','nations','units','topic_levels'));
    }
}
