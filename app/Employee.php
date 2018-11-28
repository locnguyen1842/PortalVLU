<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'username', 'password',
    ];

    public function pi(){
      return $this->belongsTo('App\PI','personalinformation_id','id');
    }

}
