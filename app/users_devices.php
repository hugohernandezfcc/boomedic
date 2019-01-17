<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users_devices extends Model
{
    protected $table = "users_devices";
    protected $fillable = [
    	'id',
    	'user_id',
		'device'
    ];

    public function user_id(){
	  return $this->belongsTo('App\User', 'user_id');
	}
    public function device(){
	  return $this->belongsTo('App\devices', 'device');
	}	
}
