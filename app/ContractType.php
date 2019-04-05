<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    protected $table = 'contract_types';

    public function pi()
    {
        return $this->hasOne('App\PI','contract_type_id','id');
    }

}
