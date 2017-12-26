<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = "recipes_tests";
    protected $fillable = [
    	'id',
		'type',
		'doctor',
		'patient',
		'notes',
		'folio',
		'date',

    ];

    public function user(){
	  return $this->belongsTo('App\User');
	}
}
