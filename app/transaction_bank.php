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
		'paymentmethod'

    ];
    

    public function user(){
	  return $this->belongsTo('App\User', 'owner');
	}
}
