<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'username', 'password',
    ];

    public function pi(){
      return $this->belongsTo('App\PI','personalinformation_id','id');
    }
}
