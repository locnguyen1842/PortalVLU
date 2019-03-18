<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'officers';

    protected $fillable = [
        'type_id',
        'personalinformation_id',
        'position_id',
        'is_concurrently',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function type(){
        return $this->belongsTo('App\OfficerType','type_id','id');
    }
    public function position(){
        return $this->belongsTo('App\PositionType','position_id','id');
    }
}
