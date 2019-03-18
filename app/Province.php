<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    public function addresses()
    {
      return $this->hasMany('App\Address','province_id','id');
    }
}
