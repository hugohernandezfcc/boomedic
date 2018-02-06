<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipes_tests extends Model
{
    protected $table = "medical_association";
    protected $fillable = [
    	'id',
    	'name'
    ];

}
