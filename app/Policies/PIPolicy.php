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


}
