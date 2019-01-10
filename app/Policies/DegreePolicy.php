<?php

namespace App\Policies;

use App\Employee;
use App\DegreeDetail;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class DegreePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update($user,DegreeDetail $degreedetail)
    {

        return $degreedetail->personalinformation_id == $user->personalinformation_id;
    }
}
