<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diagnostics extends Model
{
    protected $table = "diagnostics";
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
