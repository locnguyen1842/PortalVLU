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

    public function getOfficerByAcademicRankType($officer_type_id,$academic_type_id = 999,$contract_type_id = 999,$gender_id = 999,$nation_id = 999){

        $result = $this->where('type_id',$officer_type_id)->whereHas('pi',function ($query) use($academic_type_id,$contract_type_id,$gender_id,$nation_id){

            $query->where('show',1)->where('is_activity',1);



            if ($academic_type_id != 999) {

                $query->whereHas('academic_rank',function ($q) use($academic_type_id){
                    $q->where('type_id',$academic_type_id);
            });
            }


            if($gender_id != 999){
                $query->where('gender',$gender_id);

            }
            if($contract_type_id != 999){
                $query->where('contract_type_id',$contract_type_id);
            }
            if($nation_id != 999){
                $query->where('nation_id','!=',$nation_id);
            }

        })->get();
        return $result;
    }

    public function getOfficerByDegreeType($officer_type_id,$degree_type_id = 999,$contract_type_id = 999,$gender_id = 999,$nation_id = 999){

        $result = $this->where('type_id',$officer_type_id)->whereHas('pi',function ($query) use($degree_type_id,$contract_type_id,$gender_id, $nation_id){
            $query->where('show',1)->where('is_activity',1);


            if($degree_type_id != 999){
                $query->whereHas('degreedetails',function ($q) use($degree_type_id){
                    $q->where('degree_id',$degree_type_id);
                });

            }
            if($gender_id != 999){
                $query->where('gender',$gender_id);

            }
            if($contract_type_id != 999){
                $query->where('contract_type_id',$contract_type_id);
            }
            if($nation_id != 999){
                $query->where('nation_id','!=',$nation_id);
            }
        })->get();
        return ($result);
    }
    public function getOfficerByPosition($position_id,$contract_type_id = 999,$gender_id = 999,$nation_id= 999){

        $result = $this->where('position_id',$position_id)->whereHas('pi',function ($query) use($position_id,$contract_type_id,$gender_id,$nation_id){
            $query->where('show',1)->where('is_activity',1);

            if($nation_id != 999){
                $query->where('nation_id','!=',$nation_id);
            }

            if($gender_id != 999){
                $query->where('gender',$gender_id);

            }
            if($contract_type_id != 999){
                $query->where('contract_type_id',$contract_type_id);
            }
        })->get();
        return ($result);
    }




}
