<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicRankType extends Model
{
    protected $table = 'academic_rank_types';

    protected $fillable = [
        'name',
        'note',
    ];

    public function academic_ranks()
    {
        return $this->hasMany('App\AcademicRank','type_id','id');
    }
}
