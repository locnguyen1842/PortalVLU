<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionType extends Model
{
    protected $table = 'position_types';

    protected $fillable = [
        'name',
        'note',
    ];

    public function officers()
    {
        return $this->hasMany('App\Officer','position_id','id');
    }
}
