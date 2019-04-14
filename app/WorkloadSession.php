<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkloadSession extends Model
{
    protected $table = 'workloadsessions';
    protected $fillable = [
        'start_year','end_year'
    ];

    public function workloads()
    {
        return $this->hasMany('App\Workload','session_id','id');
    }

    public function scientific_research_workloads()
    {
        return $this->hasMany('App\ScientificResearchWorkload','session_id','id');
    }
}
