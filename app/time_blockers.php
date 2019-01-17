<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class time_blockers extends Model
{
    protected $table = "time_blockers";
    protected $fillable = [
    	'id',
		'type',  //Type Enum: professional commitment / Isnt possible attended
		'horary',
		'start', //datetime
		'end',  //datetime
		'professional_inf',
		'title',
		'color'

    ];

    public function professional_inf(){
	  return $this->belongsTo('App\professional_information');
	}
}
