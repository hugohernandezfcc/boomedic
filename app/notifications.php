<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    protected $table = "notifications";
    protected $fillable = [
		'id',
		'user_id',
		'description',
		'url',
		'type'
    ];

    public function user_id(){
	  return $this->belongsTo('App\User', 'user_id');
	}

}
