<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaborInformation extends Model
{
    protected $table = "labor_information";
    protected $fillable = [
    	'id',
		'workplace',
		'professionalPosition',
		'profInformation',
		'country',
		'state',
		'delegation',
		'colony',
		'street',
		'streetNumber',
		'interiorNumber', 
		'phone',
		'latitude', 
		'longitude',
		'postalcode'
    ];

    public function user(){
	  return $this->belongsTo('App\professional_information', 'profInformation');
	}
}
