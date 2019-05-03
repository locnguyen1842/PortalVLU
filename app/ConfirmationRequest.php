<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class ConfirmationRequest extends Model
{
    use Notifiable;
    protected $table = 'confirmation_requests';

    protected $fillable = [
        'personalinformation_id',
        'confirmation',
        'date_of_request',
        'name_of_signer',
        'first_signer',
        'second_signer',
        'address_id',
        'status',
        'number_of_month_income',
    ];

    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function address(){
        return $this->belongsTo('App\Address','address_id','id');
    }

    public function incomes(){
        return $this->hasMany('App\ConfirmationIncome','confirmation_request_id','id');
    }


}
