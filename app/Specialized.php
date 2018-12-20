<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialized extends Model
{
  protected $table = 'specializes';
  protected $fillable = [
      'name',
  ];

  public function degreedetails()
  {
    return $this->hasMany('App\DegreeDetail','specialized_id','id');
  }
}
