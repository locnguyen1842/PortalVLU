<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'address_content',
        'province_code',
        'district_code',
        'ward_code',
    ];

    public function province(){
        return $this->belongsTo('App\Province','province_code','code');
    }
    public function district(){
        return $this->belongsTo('App\District','district_code','code');
    }
    public function ward(){
        return $this->belongsTo('App\Ward','ward_code','code');
    }


    public function pi_permanent_addresses(){
        return $this->hasMany('App\PI','permanent_address_id','id');
    }
    public function pi_contact_addresses(){
        return $this->hasMany('App\PI','contact_address_id','id');
    }
}
