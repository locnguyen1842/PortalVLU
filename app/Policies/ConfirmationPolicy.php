<?php

namespace App\Policies;

use App\ConfirmationRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfirmationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function access($user,ConfirmationRequest $confirmation)
    {
        
        if($confirmation->status == 1){
            return false;
        }
        
        
        return $confirmation->personalinformation_id == $user->personalinformation_id;
    }
    
    public function send_request($user,ConfirmationRequest $confirmation){
        return $confirmation->personalinformation_id == $user->personalinformation_id;
    }

    public function preview($user,ConfirmationRequest $confirmation){
        return $confirmation->personalinformation_id == $user->personalinformation_id;
    }

    public function access_only_status_true_admin($user,ConfirmationRequest $confirmation){
        if($confirmation->status ==1 ){
            return true;
        }
        
    }
}


