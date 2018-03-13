<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class answers_clinic_history extends Model
{
    protected $table = "answers_clinic_history";
    protected $fillable = [
    	'id',
    	'answer',
		'code_translation',
		'question',
		'text_help'
    ];
    public function questions_clinic_history(){
	  return $this->belongsTo('App\questions_clinic_history');
	}

}
