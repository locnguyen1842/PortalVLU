<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'officers';

    protected $fillable = [
        'type_id',
        'personalinformation_id',
        'position_id',
        'is_concurrently',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function type(){
        return $this->belongsTo('App\OfficerType','type_id','id');
    }
    public function position(){
        return $this->belongsTo('App\PositionType','position_id','id');
    }

    public function getOfficerByAcademicRankType($officer_type_id,$academic_type_id){
        $result = $this->where('type_id',$officer_type_id)->whereHas('pi',function ($query) use($academic_type_id){
            $query->whereHas('academic_rank',function ($q) use($academic_type_id){
                $q->where('type_id',$academic_type_id);
            });
        })->get();
        return $result;
    }

    public function getOfficerByDegreeType($officer_type_id,$degree_type_id){

        // $result = $this->where('type_id',1)->whereHas('pi')->whereHas('degreedetails')->count();
        $result = $this->where('type_id',$officer_type_id)->whereHas('pi',function ($query) use($degree_type_id){
            $query->whereHas('degreedetails',function ($q) use($degree_type_id){
                $q->where('degree_id',$degree_type_id);
            });
        })->get();
        return ($result);
    }
}
