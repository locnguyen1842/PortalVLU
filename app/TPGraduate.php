<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPGraduate extends Model
{
    protected $table = 'training_process_graduate_educations';

    protected $fillable = [
        'type_of_training',
        'place_of_training',
        'field_of_study',
        'nation_of_training',
        'year_of_graduation',
        'scientific_background_id',
    ];

    public function scientific_background(){
        return $this->belongsTo('App\ScientificBackground','scientific_background_id','id');
    }

}
