<?php

namespace App\Policies;

use App\Workload;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkloadPolicy
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

    public function access($user,Workload $workload)
    {

        return $workload->personalinformation_id == $user->personalinformation_id;
    }
}


