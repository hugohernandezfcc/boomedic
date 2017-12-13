<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class labor_information extends Model
{
    protected $table = "LaborInformation";
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
	  return $this->belongsTo('App\ProfessionalInformation', 'profInformation');
	}
}
