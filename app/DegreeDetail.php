<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreeDetail extends Model
{
    protected $table = 'degreedetails';

    protected $fillable = [
        'date_of_issue',
        'place_of_issue',
        'date_of_recruiment',
        'position',
        'professional_title',
    ];

    public function pi(){
      return $this->belongsTo('App\PI','personalinformation_id','id');
    }

    public function degree(){
      return $this->belongsTo('App\Degree','degree_id','id');
    }

}
