<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    protected $table = "medications";
    protected $fillable = [
    	'id',
		'active',  //enum [confirmed, not confirmed, finished]
		'recipe_medicines',
		'start_date',
		'scheduller_active',
		'scheduller_inactive',
		'next_time'
    ];
    

    public function recipe_medicines(){
	  return $this->belongsTo('App\cli_recipes_tests', 'recipe_medicines');
	}
}
