<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScientificResearchWorkload extends Model
{
    protected $table = 'scientific_research_workloads';

    protected $fillable = [
        'personalinformation_id',
        'session_id',
        'name_of_work',
        'detail_of_work',
        'explain_of_work',
        'unit_of_work',
        'quantity_of_work',
        'converted_standard_time',
        'converted_time',
        'note',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }

    public function session(){
        return $this->belongsTo('App\WorkloadSession','session_id','id');
    }
}
