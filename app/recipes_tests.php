<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipes_tests extends Model
{
    protected $table = "recipes_tests";
    protected $fillable = [
    	'id',
		'type',
		'doctor',
		'patient',
		'notes',
		'folio',
		'date',
		'Data_frontend'

    ];

    public function doctor(){
	  return $this->belongsTo('App\User', 'doctor');
	}

	public function patient(){
	  return $this->belongsTo('App\User', 'patient');
	}

	public function apiDoctor(){
		return $this->BelongsTo(User::class, 'doctor', 'id');
	}

	public function apiPatient(){
		return $this->BelongsTo(User::class, 'patient', 'id');
	}
}
