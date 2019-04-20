<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmationRequest extends Model
{
    protected $table = 'confirmation_requests';

    protected $fillable = [
        'reason',
        'personalinformation_id',
        'confirmation',
        'date_of_request',
        'name_of_signer',
        'first_signer',
        'second_signer',
        'address_id',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }


}
