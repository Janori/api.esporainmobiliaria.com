<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';

    function salesMan(){
    	return $this->belongsTo('App\User');
    }
    function buyer(){
    	return $this->belongsTo('App\Models\Customer');
    }
}
