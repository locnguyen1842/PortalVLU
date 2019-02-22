<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPForeignLanguage extends Model
{
    protected $table = 'training_process_foreign_languages';

    protected $fillable = [
        'language',
        'usage_level',
        'scientific_background_id',
    ];

    public function scientific_background(){
        return $this->belongsTo('App\ScientificBackground','scientific_background_id','id');
    }

}
