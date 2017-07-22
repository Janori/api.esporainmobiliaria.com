<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $table = 'dates';

    public function prospect(){
    	return $this->belongsTo('App\Models\Prospect');
    }
    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
