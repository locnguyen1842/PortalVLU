<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmationIncome extends Model
{
    protected $table = 'confirmation_incomes';

    protected $fillable = [
        'confirmation_request_id',
        'date_of_income',
        'amount_of_income',
    ];

    public function cr(){
        return $this->belongsTo('App\ConfirmationRequest','confirmation_request_id','id');
    }
   
}
