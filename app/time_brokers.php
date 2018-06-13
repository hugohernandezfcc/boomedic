<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class time_brokers extends Model
{
    protected $table = "time_brokers ";
    protected $fillable = [
    	'id',
		'type',  //Type Enum: professional commitment / Isnt possible attended
		'horary',
		'start', //datetime
		'end',  //datetime
		'professional_inf'

    ];

    public function professional_inf(){
	  return $this->belongsTo('App\professional_information');
	}
}
