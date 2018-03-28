<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = ['name', 'building_id', 'user_id', 'sale_date', 'amount', 'customer_id', 'extra_data', 'created_at', 'updated_at'];
    function salesMan(){
    	return $this->belongsTo('App\User');
    }
    function buyer(){
    	return $this->belongsTo('App\Models\Customer');
    }
}
