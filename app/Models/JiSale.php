<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiSale extends Model
{
    protected $table = 'JiSale';

    function salesMan(){
    	return $this->belongsTo('App\Models\JiUser');
    }
    function buyer(){
    	return $this->belongsTo('App\Models\JiCustomer');
    }
}
