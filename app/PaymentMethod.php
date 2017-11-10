<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = "paymentsmethods";
    protected $fillable = [
    	'id',
		'provider',
		'typemethod',
		'country',
		'month',
		'year',
		'cvv',
		'cardnumber',
		'owner',
		'credit_debit',
		'bank'
    ];
    

    public function user(){
	  return $this->belongsTo('App\User', 'owner');
	}
}
