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
      'email_address',
      'phone_number',
      'identity_card',
      'date_of_issue',
      'place_of_issue',
      'date_of_recruitment',
      'show',
      'position',
      'professional_title',
      'unit_id',
      'new',
      'home_town',
      'fax',
      'permanent_address_id',
      'contact_address_id',
      'is_activity',
      'contract_type_id',
    ];

    public function degreedetails()
    {
        return $this->hasMany('App\DegreeDetail','personalinformation_id','id');
    }
    public function scientificbackgrounds()
    {
        return $this->hasOne('App\ScientificBackground','personalinformation_id','id');
    }
    public function admin(){
        return $this->hasOne('App\Admin','personalinformation_id','id');
    }
    public function employee(){
        return $this->hasOne('App\Employee','personalinformation_id','id');
    }
    public function workloads(){
        return $this->hasMany('App\Workload','personalinformation_id','id');
    }
    public function nation(){
        return $this->belongsTo('App\Nation','nation_id','id');
    }
    public function unit(){
        return $this->belongsTo('App\Unit','unit_id','id');
    }
    public function contract_type(){
        return $this->belongsTo('App\ContractType','contract_type_id','id');
    }
    public function academic_rank()
    {
        return $this->hasOne('App\AcademicRank','personalinformation_id','id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher','personalinformation_id','id');
    }
    public function officer()
    {
        return $this->hasOne('App\Officer','personalinformation_id','id');
    }

    public function permanent_address(){
        return $this->belongsTo('App\Address','permanent_address_id','id');
    }
    public function contact_address(){
        return $this->belongsTo('App\Address','contact_address_id','id');
    }


}
