<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model{
    
    protected $table = 'locations';

    protected $fillable = ['latitude', 'longitude'];

    public function lands(){
    	return $this->hasMany('App\Models\Land', 'location_id');
    }

    public function branches(){
    	return $this->hasMany('App\Models\Branch', 'location_id');
    }

}
