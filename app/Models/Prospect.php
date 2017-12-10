<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $table = 'prospects';
    protected $fillable = ['extra_data'];

    public function building(){
    	return $this->belongsTo('App\Models\Building');
    }
    public function customer(){
    	return $this->belongsTo('App\Models\Customer');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
