<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipes_tests extends Model
{
	/**
	 * Table responsable of join recipes and tests rusults.
	 * @var string
	 */
    protected $table = "recipes_tests";
    protected $fillable = [
    	'id',
		'type', //['Recipe', 'Test']
		'doctor', // who created it
		'patient',// who recived it
		'notes',	
		'folio',
		'date',

    ];

    public function user(){
	  return $this->belongsTo('App\User');
	}
}
