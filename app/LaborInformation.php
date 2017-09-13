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
		'address',
		'profInformation'
    ];

    public function user(){
	  return $this->belongsTo('App\ProfessionalInformation');
	}
}
