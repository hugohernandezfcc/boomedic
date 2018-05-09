<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    protected $table = "conversations";
    protected $fillable = [
    	'id',
		'name',
		'table',
		'id_record',
		'doctor'
    ];

    public function doctor(){
	  return $this->belongsTo('App\User');
	}
}
