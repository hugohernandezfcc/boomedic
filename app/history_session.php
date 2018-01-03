<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_session extends Model
{
    protected $table = 'history_session';
    protected $fillable = [
    	'id',
		'browser',
		'dateIn',
		'status',
		'dateOut',
		'createdBy'
    ];
    
    public function user(){
	  return $this->belongsTo('App\User', 'createdBy');
	}
}
