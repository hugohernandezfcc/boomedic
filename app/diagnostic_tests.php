<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diagnostic_tests extends Model
{
    protected $table = "diagnostic_tests";
    protected $fillable = [
    	'id',
		'name',
		'description',
		'code',
		'parent'
    ];

    public function user(){
	  return $this->belongsTo('App\User');
	}

	public function owner(){
		$dtParent = $this->BelongsTo(diagnostic_tests::class, 'parent', 'id');
		if($dtParent !==null){
			return  $dtParent;
		}else{
			$test = new diagnostic_tests;
			return $test;
		}
		
	}
}
