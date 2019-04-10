<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diagnostic_test_result extends Model
{
    protected $table = "diagnostic_test_result";
    protected $fillable = [
		'id',
		'details',
		'url',
		'email',
		'patient',
		'diagnostic_test',
		'recipes_test',
		'header_email',
		'body_email',
		'structure_email',
		'date_email',
		'subject_email',
		'text_email',
		'viewed'

    ];

    public function patient(){
	  return $this->belongsTo('App\User', 'patient');
	}
	public function diagnostic_test(){
	  return $this->belongsTo('App\diagnostic_tests', 'diagnostic_test');
	}
	public function recipes_test(){
	  return $this->belongsTo('App\recipes_tests', 'recipes_test');
	}
}
