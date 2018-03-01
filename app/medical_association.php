<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medical_association extends Model
{
    protected $table = "medical_association";
    protected $fillable = [
    	'id',
    	'name',
    	'parent',
    	'members',
    	'facebook',
    	'twitter',
    	'email',
    	'address',
    	'phone',
    	'mobile'
    ];
        public function medical_association()
    {
        return $this->belongsTo('App\medical_association', 'parent');
    }

}
