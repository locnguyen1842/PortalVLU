<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workload extends Model
{
    protected $table = 'workloads';
    protected $fillable = [
        'personalinformation_id',
        'subject_code',
        'subject_name',
        'number_of_lessons',
        'class_code',
        'number_of_students',
        'total_workload',
        'theoretical_hours',
        'practice_hours',
        'note',
        'unit_id',
        'semester',
        'session_id',
    ];

    public function workloadsession()
    {
        return $this->hasMany('App\WorkloadSession','session_id','id');
    }
}
