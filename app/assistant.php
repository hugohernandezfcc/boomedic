<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assistant extends Model
{
    protected $table = "assistant";
    protected $fillable = [
    	'id',
		'user_assist',
		'user_doctor',
		'confirmation',
        'profile', //Enum [none, read, write] default: none
        'calendar', //Enum [none, read, write] default: none
        'chat',  //Enum [none, read, write] default: none
        'assistant', //Enum [none, read, write] default: none 
        'workboard' //Enum [none, read, write] default: none
    ];

    public function user_assist(){
	  return $this->belongsTo('App\User');
	}
    public function user_doctor(){
	  return $this->belongsTo('App\User');
	}	
}
