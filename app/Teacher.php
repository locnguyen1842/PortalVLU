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

    public function getTeacherByAcademicRankType($teacher_type_id,$academic_type_id){
        $result = $this->where('type_id',$teacher_type_id)->whereHas('pi',function ($query) use($academic_type_id){
            $query->where('show',1)->where('is_activity',1)->whereHas('academic_rank',function ($q) use($academic_type_id){
                $q->where('type_id',$academic_type_id);
            });
        })->get();
        return $result;
    }
    public function getTeacherByDegreeType($teacher_type_id,$degree_type_id){

        // $result = $this->where('type_id',1)->whereHas('pi')->whereHas('degreedetails')->count();
        $result = $this->where('type_id',$teacher_type_id)->whereHas('pi',function ($query) use($degree_type_id){
            $query->where('show',1)->where('is_activity',1)->where('is_activity',1)->whereHas('degreedetails',function ($q) use($degree_type_id){
                $q->where('degree_id',$degree_type_id);
            });
        })->get();
        return ($result);
    }

    public function getTeacherByAge($teacher_type_id,$min_age,$max_age){

        $min_age = (string) $min_age;
        $max_age = (string) $max_age;
        // $result = $this->where('type_id',1)->whereHas('pi')->whereHas('degreedetails')->count();
        $result = $this->where('type_id',$teacher_type_id)->whereHas('pi',function ($query) use($min_age,$max_age){
            // $current_age = Carbon::parse($query->date_of_birth)->age;

            $min_date = Carbon::today()->subYears($max_age);
            $max_date = Carbon::today()->subYears($min_age)->endOfDay();
            $query->where('show',1)->where('is_activity',1)->whereBetween('date_of_birth',[$min_date,$max_date]);

        })->get();
        return ($result);
    }

    public function getTeacherByRetirementInYear(){

        $start_of_year = Carbon::now()->startOfYear();
        $end_of_year = Carbon::now()->endOfYear();

        $result = $this
        ->where('type_id',1)
        ->whereBetween('date_of_retirement',[$start_of_year,$end_of_year])
        ->whereHas('pi',function($q){
            $q->where('show',1)->where('is_activity',1);
        })->get();
        return $result;

    }

    public function getTeacherByRecruimentInYear(){

        $start_of_year = Carbon::now()->startOfYear();
        $end_of_year = Carbon::now()->endOfYear();

        $result = $this->where('type_id',1)->whereHas('pi',function($query) use($start_of_year,$end_of_year){
            $query->where('show',1)->where('is_activity',1)->whereBetween('date_of_recruitment',[$start_of_year,$end_of_year]);
        })->get();
        return $result;

    }
}
