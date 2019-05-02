<?php

namespace App\Policies;

use App\Admin;
use App\PI;
use Illuminate\Auth\Access\HandlesAuthorization;

class PIPolicy
{
    use HandlesAuthorization;


    public function cud($admin, PI $pi)
    {
        if($admin->isSupervisor()){
            return false;
        }else{
            return true;
        }
    }

    public function actAsFacultyLeader($employee, PI $pi)
    {
        if($employee->isFacultyLeader()){
            return true;
        }else{
            return false;
        }
    }

    public function onlyAccessWithSameFaculty($employee , PI $pi){
        if($employee->pi->unit_id == $pi->unit_id){
            return true;
        }else{
            return false;
        }
    }


}
