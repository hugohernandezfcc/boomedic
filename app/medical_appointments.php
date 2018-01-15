<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medical_appointments extends Model
{
    protected $table = "medical_appointments";
    protected $fillable = [
		'id',
		'user',
		'user_doctor',
		'when',
		'status',
		'workplace'
    ];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}

	public function owner(){
		return $this->BelongsTo(User::class, 'user', 'id');
	}

	public function doctor(){
		return $this->BelongsTo(User::class, 'user_doctor', 'id');
	}
}
