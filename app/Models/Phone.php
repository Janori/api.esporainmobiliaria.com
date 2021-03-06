<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function customer(){
    	return $this->belongsTo('App\Models\Customer');
    }
}
