<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipes_tests extends Model
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
		'appointment'
    ];

    public function user(){
	  return $this->belongsTo('App\User');
	}
}
