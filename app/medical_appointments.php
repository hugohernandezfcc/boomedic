<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medical_appointments extends Model
{
    protected $table = "medical_appointments";
    protected $fillable = [
		'id',
		'user',
		'user_doctor',
		'when',
		'status', // 'Registered', 'Taked','No completed'
		'workplace',
		'appointment', 
		'qualification',
		'invoiced'
    ];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}
	public function appointment(){
	  return $this->belongsTo('App\medical_appointments', 'appointment');
	}
}
