<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaborInformation extends Model
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
		'phone'
    ];

    public function user(){
	  return $this->belongsTo('App\ProfessionalInformation');
	}
}
