<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiPhone extends Model
{
    protected $table = 'phones';

    public function user(){
    	return $this->belongsTo('App\Models\JiUser');
    }
    public function customer(){
    	return $this->belongsTo('App\Models\JiCustomer');
    }
}
