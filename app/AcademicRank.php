<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicRank extends Model
{
    protected $table = 'academic_ranks';

    protected $fillable = [
        'type_id',
        'personalinformation_id',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function type(){
        return $this->belongsTo('App\AcademicRankType','type_id','id');
    }



}
