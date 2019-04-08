<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table ='religions';

    public function pis()
    {
        return $this->hasMany('App\PI','religion_id','id');
    }
}
