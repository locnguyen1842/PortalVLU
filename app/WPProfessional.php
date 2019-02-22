<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WPProfessional extends Model
{
    protected $table = 'professional_working_process';

    protected $fillable = [
        'period_time',
        'place_of_work',
        'work_of_undertake',
        'scientific_background_id',
    ];

    public function scientific_background(){
        return $this->belongsTo('App\ScientificBackground','scientific_background_id','id');
    }

}
