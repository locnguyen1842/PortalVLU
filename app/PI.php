<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PI extends Model
{
    protected $table = 'personalinformations';

    protected $fillable = [
      'employee_code',
      'full_name',
      'first_name',
      'nation_id',
      'gender',
      'date_of_birth',
      'place_of_birth',
      'permanent_address',
      'contact_address',
      'email_address',
      'phone_number',
      'identity_card',
      'date_of_issue',
      'place_of_issue',
      'date_of_recruitment',
      'show',
      'position',
      'professional_title',
      'unit',
      'new',
    ];

    public function degreedetails()
    {
      return $this->hasMany('App\DegreeDetail','personalinformation_id','id');
    }
    public function admin(){
      return $this->hasOne('App\Admin','personalinformation_id','id');
    }
    public function employee(){
      return $this->hasOne('App\Employee','personalinformation_id','id');
    }
    public function nation(){
      return $this->belongsTo('App\Nation','nation_id','id');
    }




}
