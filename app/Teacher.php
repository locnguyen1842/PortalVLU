<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'type_id',
        'personalinformation_id',
        'title_id',
        'is_retired',
        'date_of_retirement',
        'is_excellent_teacher',
        'is_national_teacher',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function type(){
        return $this->belongsTo('App\TeacherType','type_id','id');
    }
    public function title(){
        return $this->belongsTo('App\TeacherTitle','title_id','id');
    }

    public function getTeacherByAcademicRankType($teacher_type_id,$academic_type_id=999,$contract_type_id=999,$gender_id=999,$nation_id=999){
        $result = $this->where('type_id',$teacher_type_id)->whereHas('pi',function ($query) use($academic_type_id,$contract_type_id,$gender_id,$nation_id){
            $query->where('show',1)->where('is_activity',1);
            if($gender_id != 999){
                $query->where('gender',$gender_id);

            }
            if($contract_type_id != 999){
                $query->where('contract_type_id',$contract_type_id);
            }
            if($nation_id != 999){
                $query->where('nation_id','!=',$nation_id);
            }
            if($academic_type_id !=999){
                $query->whereHas('academic_rank',function ($q) use($academic_type_id){
                    $q->where('type_id',$academic_type_id);
                });
            }

        })->get();
        return $result;
    }
    public function getTeacherByDegreeType($teacher_type_id,$degree_type_id=999,$contract_type_id=999,$gender_id=999,$nation_id=999){

        // $result = $this->where('type_id',1)->whereHas('pi')->whereHas('degreedetails')->count();
        $result = $this->where('type_id',$teacher_type_id)->whereHas('pi',function ($query) use($degree_type_id,$contract_type_id,$gender_id,$nation_id){
            $query->where('show',1)->where('is_activity',1);
            if($gender_id != 999){
                $query->where('gender',$gender_id);

            }
            if($contract_type_id != 999){
                $query->where('contract_type_id',$contract_type_id);
            }
            if($nation_id != 999){
                $query->where('nation_id','!=',$nation_id);
            }

            if($degree_type_id !=999){
                $query->whereHas('degreedetails',function ($q) use($degree_type_id){
                    $q->where('degree_id',$degree_type_id);
                });
            }



        })->get();
        return ($result);
    }



    public function getTeacherByAge($teacher_type_id,$min_age,$max_age,$contract_type_id=999,$gender_id=999,$nation_id=999){

        $min_age = (string) $min_age;
        $max_age = (string) $max_age;
        $min_date = Carbon::today()->subYears($max_age);
        $max_date = Carbon::today()->subYears($min_age)->endOfDay();
        // $result = $this->where('type_id',1)->whereHas('pi')->whereHas('degreedetails')->count();
        $result = $this->where('type_id',$teacher_type_id)->whereHas('pi',function ($query) use($min_date,$max_date,$contract_type_id,$gender_id,$nation_id){
            $query->where('show',1)->where('is_activity',1)->whereBetween('date_of_birth',[$min_date,$max_date]);
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

    public function getTeacherByRetirementInYear($teacher_type_id,$contract_type_id=999,$gender_id=999,$nation_id=999){

        $start_of_year = Carbon::now()->startOfYear();
        $end_of_year = Carbon::now()->endOfYear();
        $result = $this->where('type_id',$teacher_type_id)
                        ->whereBetween('date_of_retirement',[$start_of_year,$end_of_year])
                        ->whereHas('pi',function($query) use($contract_type_id,$gender_id,$nation_id){
                            $query->where('show',1)->where('is_activity',1);
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

    public function getTeacherByRecruimentInYear($teacher_type_id,$contract_type_id=999,$gender_id=999,$nation_id=999){

        $start_of_year = Carbon::now()->startOfYear();
        $end_of_year = Carbon::now()->endOfYear();

        $result = $this->where('type_id',$teacher_type_id)
                        ->whereHas('pi',function($query) use($start_of_year,$end_of_year,$contract_type_id,$gender_id,$nation_id){
                            $query->where('show',1)
                                    ->where('is_activity',1)
                                    ->whereBetween('date_of_recruitment',[$start_of_year,$end_of_year]);
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
}
