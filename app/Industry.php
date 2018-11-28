<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industries';


    protected $fillable = [
        'name',
    ];

    public function pi(){
      return $this->belongsToMany('App\PI','industry_pi','industry_id','personalinformation_id');
    }
}
