<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items_Conversations extends Model
{
    protected $table = "items_conversations";
    protected $fillable = [
    	'id',
		'name',
		'by',
		'conversation',
		'type',
		'parent',
		'text_body',
		'viewed'
    ];

    public function by(){
	  return $this->belongsTo('App\User');
	}
	public function conversation(){
	  return $this->belongsTo('App\Conversations');
	}
	public function parent(){
	  return $this->belongsTo('App\Items_conversations');
	}
}
