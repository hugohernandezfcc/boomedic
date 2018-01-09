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
}
