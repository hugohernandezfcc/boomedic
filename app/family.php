<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class family extends Model
{
    protected $table = "family";
    protected $fillable = [
    	'id',
    	'activeUser',
		'passiveUser',
		'relationship',
		'activeUserStatus',
		'parent',
		'type'
    ];

    public function parent(){
	  return $this->belongsTo('App\User', 'parent');
	}
	public function activeUser(){
	  return $this->belongsTo('App\User', 'activeUser');
	}
	public function passiveUser(){
	  return $this->belongsTo('App\User', 'passiveUser');
	}
}

