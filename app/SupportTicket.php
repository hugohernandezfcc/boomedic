<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = "support_tickets";
    protected $fillable = [
    	'id',
		'user',
		'email',
		'userType',
		'ticketDescription',
		'userId'
    ];
    

    public function user(){
	  return $this->belongsTo('App\User', 'userId');
	}
}
