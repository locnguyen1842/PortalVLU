<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
  protected $table = 'units';
  protected $fillable = [
      'name','unit_code'
  ];

  public function pis()
  {
    return $this->hasMany('App\PI','unit_id','id');
  }
}
