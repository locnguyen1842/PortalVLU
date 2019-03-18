<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public function addresses()
    {
      return $this->hasMany('App\Address','district_id','id');
    }
}
