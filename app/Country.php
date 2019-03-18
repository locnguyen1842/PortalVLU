<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function pis()
    {
      return $this->hasMany('App\PI','country_id','id');
    }
}
