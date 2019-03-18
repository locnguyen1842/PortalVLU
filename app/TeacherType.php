<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherType extends Model
{
    protected $table = 'teacher_types';

    protected $fillable = [
        'name',
        'note',
    ];

    public function teachers()
    {
        return $this->hasMany('App\Teacher','type_id','id');
    }
}
