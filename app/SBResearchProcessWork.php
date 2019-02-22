<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SBResearchProcessWork extends Model
{
    protected $table = 'scientific_research_process_works';

    protected $fillable = [
        'name_of_works',
        'year_of_publication',
        'name_of_journal',
        'scientific_background_id',
    ];

    public function scientific_background(){
      return $this->belongsTo('App\ScientificBackground','scientific_background_id','id');
    }

}
