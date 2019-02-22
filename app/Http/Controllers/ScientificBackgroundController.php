<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ScientificBackground;

class ScientificBackgroundController extends Controller
{
    public function getdetailAdmin($pi_id){
        $sb = ScientificBackground::where('personalinformation_id',$pi_id)->firstOrFail();
        return view('admin.sb.sb-detail', compact('pi_id','sb'));

    }
}
