<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class privacy_statement extends Model
{
    protected $table = 'privacy_statement';
    protected $fillable = [
    	'id',
		'description',
		'created_at',
		'updated_at'

    ];
}
