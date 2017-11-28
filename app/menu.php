<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'menus';

    protected $fillable = ['text', 'order', 'label', 'icon', 'label_color', 'url', 'to', 'typeitem', 'parent'];

    public function menu()
    {
        return $this->belongsTo('App\menu', 'parent');
    }
}
