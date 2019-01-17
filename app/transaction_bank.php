<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction_bank extends Model
{
    protected $table = 'transaction_bank';
    protected $fillable = [
    	'id',
		'receiver',
		'amount',
		'paymentmethod',
		'transaction',
		'status',
		'appointments',
		'company',
		'type_doctor'

    ];
    

    public function paymentmethod(){
	  return $this->belongsTo('PaymentMethod', 'paymentmethod');
	}

	public function company(){
	  return $this->belongsTo('company_information', 'company');
	}
}
