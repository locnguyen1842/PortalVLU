<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficerType extends Model
{
    protected $table = 'officer_types';

    protected $fillable = [
        'name',
        'note',
    ];

    public function officers()
    {
        return $this->hasMany('App\Officer','type_id','id');
    }
}
