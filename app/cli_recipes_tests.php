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

    ];

    public function recipes_tests(){
	  return $this->belongsTo('App\recipes_tests', 'recipes_tests');
	}

	public function medicine(){
	  return $this->belongsTo('App\medicines', 'medicine');
	}

	public function test(){
	  return $this->belongsTo('App\diagnostic_tests', 'test');
	}

	public function apiRecipesTest(){
		return $this->BelongsTo(recipes_tests::class, 'recipes_tests', 'id');
	}

	public function apiMedicine(){
		return $this->BelongsTo(recipes_tests::class, 'medicine', 'id');
	}

	public function apiDiagnostic(){
		return $this->BelongsTo(recipes_tests::class, 'test', 'id');
	}
}
