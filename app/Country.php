<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';


    public function degree_details()
    {
      return $this->hasMany('App\DegreeDetail','nation_of_issue_id','id');
    }
}
