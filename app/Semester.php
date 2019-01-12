<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $fillable = [
        'name','alias'
    ];

    public function workloads()
    {
        return $this->hasMany('App\Workload','semester_id','id');
    }
}
