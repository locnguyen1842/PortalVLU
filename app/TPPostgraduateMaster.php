<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPPostgraduateMaster extends Model
{
    protected $table = 'training_process_postgraduate_education_master_degrees';

    protected $fillable = [
        'field_of_study',
        'year_of_issue',
        'place_of_training',
        'scientific_background_id',
    ];

    public function scientific_background(){
        return $this->belongsTo('App\ScientificBackground','scientific_background_id','id');
    }

}
