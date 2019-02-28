<?php

namespace App\Policies;

use App\Employee;
use App\ScientificBackground;
use Illuminate\Auth\Access\HandlesAuthorization;

class SBPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update($user,ScientificBackground $sb)
    {

        return $sb->personalinformation_id == $user->personalinformation_id;
    }
}
