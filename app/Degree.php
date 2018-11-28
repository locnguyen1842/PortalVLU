<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degrees';
    protected $fillable = [
        'name'
    ];

    public function degreedetails(){
      return $this->hasMany('App\DegreeDetail','degree_id','id');
    }

}
