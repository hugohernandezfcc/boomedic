<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class professional_information extends Model
{
    protected $table = "professional_information";
    protected $fillable = [
		'specialty',
		'schoolOfMedicine',
		'facultyOfSpecialization',
		'practiseProfessional',
		'user',
		'professional_license',
		'medical_society'
    ];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}

	public function userApi(){
		return $this->BelongsTo(User::class, 'user', 'id');
	}

	public function laborInfo(){
		return $this->hasMany(LaborInformation::class, 'profInformation', 'id');
	}
}
