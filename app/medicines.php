<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicines extends Model
{
    protected $table = "medicines";
    protected $fillable = [
    	'id',
		'name',
		'description',
		'code',
		'parent'
    ];

    public function user(){
	  return $this->belongsTo('App\User');
	}

	public function owner(){
		return $this->BelongsTo(medicines::class, 'parent', 'id');
	}

	public function cliRecipesTest(){
		return $this->hasMany(cli_recipes_tests::class, 'medicine', 'id')
	}
}
