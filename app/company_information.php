<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_information extends Model
{
    protected $table = "company_information";
    protected $fillable = [
    	'id',
		'name',
		'email'
    ];
}
