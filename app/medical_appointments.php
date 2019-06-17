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
		'status', // Enum(Registered, Taked, No completed)
		'workplace',
		'appointment',
		'sub_status', //Enum (by doctor, by patient)->sub_status de "Registered", (in time, out of time by doctor, out of time by patient)->sub_status de "Taked", (cancel by doctor, cancel by patient)->sub_status de "No completed"
		'aware', //boolean for close no completed
		'definitive',
		'reasontocancel',
		'reschedule',
		'reschedule_options',
		'Height',
		'weight',
		'temperature',
		'cranial_capacity',
		'waist_diameter',
		'blood_pressure_pa',
		'heart_rate',
		'breathing_frequency',
		'descriptions'
    ];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}
	public function appointment(){
	  return $this->belongsTo('App\medical_appointments', 'appointment');
	}
}
