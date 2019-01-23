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
		'posology'
    ];
    

    public function recipe_medicines(){
	  return $this->belongsTo('App\cli_recipes_tests', 'recipe_medicines');
	}
}
