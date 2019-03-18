<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherTitle extends Model
{
    protected $table = 'teacher_titles';

    protected $fillable = [
        'name',
        'note',
    ];

    public function teachers()
    {
        return $this->hasMany('App\Teacher','title_id','id');
    }
}
