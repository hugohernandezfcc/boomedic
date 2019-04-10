<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cli_recipes_tests extends Model
{
    protected $table = "cli_recipes_tests";
    protected $fillable = [
    	'id',
		'medicine',
		'test',
		'recipe_test',
		'diagnostic',
		'frequency_days',
		'posology'

    ];

    public function recipes_tests(){
	  return $this->belongsTo('App\recipes_tests', 'recipes_tests');
	}
}
