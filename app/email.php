<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Email extends Model
{
    protected $table = "emails";
    protected $fillable = [
    	'id',
		'userId',
		'email',
		'date',
		'sender',
		'recipient',
		'subject',
		'message',
		'parent'
    ];
    
    public function user(){
	  return $this->belongsTo('App\User', 'userId');
	}

	public function owner(){
		return $this->BelongsTo(User::class, 'userId', 'id');
	}
}