<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaderType extends Model
{
    protected $table = 'leader_types';

    public function pis()
    {
        return $this->hasMany('App\PI','personalinformation_id','id');
    }
}
