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
		'labInformation'
    ];

    public function labInformation(){
	  return $this->belongsTo('App\labor_information', 'labInformation');
	}
}
