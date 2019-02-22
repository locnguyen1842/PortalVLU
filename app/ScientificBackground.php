<?php

namespace App;
use App\PI;
use App\ScientificBackground;
use Illuminate\Database\Eloquent\Model;

class ScientificBackground extends Model
{
    protected $table = 'scientific_backgrounds';

    protected $fillable = [
        'highest_scientific_title',
        'year_of_appointment',
        'personalinformation_id',
        'address',
        'highest_degree',
        'orga_phone_number',
        'home_phone_number',
        'mobile_phone_number',

    ];

    public function pi(){
      return $this->belongsTo('App\PI','personalinformation_id','id');
    }

    public function research_process_works(){
        return $this->hasMany('App\SBResearchProcessWork','scientific_background_id','id');
    }
    public function research_topics(){
        return $this->hasMany('App\SBResearchTopic','scientific_background_id','id');
    }
    public function tp_postgraduate_doctors(){
        return $this->hasMany('App\TPPostgraduateDoctor','scientific_background_id','id');
    }
    public function tp_postgraduate_masters(){
        return $this->hasMany('App\TPPostgraduateMaster','scientific_background_id','id');
    }
    public function tp_graduates(){
        return $this->hasMany('App\TPGraduate','scientific_background_id','id');
    }
    public function tp_foreign_languages(){
        return $this->hasMany('App\TPForeignLanguage','scientific_background_id','id');
    }
    public function wp_professionals(){
        return $this->hasMany('App\WPProfessional','scientific_background_id','id');
    }

    public function getHighestDegree($pi_id){
        $pi = PI::find($pi_id);
        $highest_st_al = 1;
        $highest_st = null;
        foreach($pi->degreedetails as $degreedetail){
            if($degreedetail->degree_id == 1 ||$degreedetail->degree_id == 2 ||$degreedetail->degree_id == 3){
                if($degreedetail->degree->alias >= $highest_st_al){
                    $highest_st_al = $degreedetail->degree->alias;
                    $highest_st = $degreedetail;
                }
            }
        }
        return $highest_st; //return a degreedetail
    }

}
