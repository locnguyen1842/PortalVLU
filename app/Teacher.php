<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'type_id',
        'personalinformation_id',
        'title_id',
        'is_retired',
        'date_of_retirement',
        'is_excellent_teacher',
        'is_national_teacher',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function type(){
        return $this->belongsTo('App\TeacherType','type_id','id');
    }
    public function title(){
        return $this->belongsTo('App\TeacherTitle','title_id','id');
    }
}
