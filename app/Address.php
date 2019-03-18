<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'address_content',
        'province_id',
        'district_id',
        'ward_id',
    ];

    public function province(){
        return $this->belongsTo('App\Province','province_id','id');
    }
    public function district(){
        return $this->belongsTo('App\Province','district_id','id');
    }
    public function ward(){
        return $this->belongsTo('App\Province','ward_id','id');
    }

    public function pi_permanent_addresses(){
        return $this->hasMany('App\PI','permanent_address_id','id');
    }
    public function pi_contact_addresses(){
        return $this->hasMany('App\PI','contact_address_id','id');
    }
}
