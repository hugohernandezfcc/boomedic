<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devices extends Model
{
    protected $table = "devices";
    protected $fillable = [
    	'id',
		'token_registration',
		'uuid_device'
    ];

}
