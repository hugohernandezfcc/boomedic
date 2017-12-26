<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = "cli_recipes_tests";
    protected $fillable = [
    	'id',
		'medicine',
		'test',
		'recipe_test',

    ];

    public function recipes_tests(){
	  return $this->belongsTo('App\recipes_tests', 'recipes_tests');
	}
}
