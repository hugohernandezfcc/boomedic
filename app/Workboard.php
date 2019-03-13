<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workboard extends Model
{
    protected $table = "workboard";
    protected $fillable = [
    	'id',
		'workingDays', 
		'workingHours',
		'labInformation',
		'start',
		'end',
		'fixed_schedule',
		'patient_duration_attention',
		'oldnew'
    ];

    public function labInformation(){
	  return $this->belongsTo('App\labor_information', 'labInformation');
	}
}
