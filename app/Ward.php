<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';
    public function addresses()
    {
      return $this->hasMany('App\Address','ward_id','id');
    }
}
