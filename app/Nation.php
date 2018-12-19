<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    protected $table = 'nations';
    protected $fillable = [
        'name',
    ];

    public function pis()
    {
      return $this->hasMany('App\PI','nation_id','id');
    }
}
