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
		'dateexpired',
		'cvv',
		'cardnumber',
		'owner'
    ];
    

    public function user(){
	  return $this->belongsTo('App\User', 'owner');
	}
}
