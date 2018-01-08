<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parameters_system extends Model
{
    protected $table = "parameters_system";
    protected $fillable = [
    	'id',
		'use',
		'where',
		'value',
		'code',
		'type',
		'self'
    ];

    public function user(){
	  return $this->belongsTo('App\parameters_system', 'self');
	}
}
