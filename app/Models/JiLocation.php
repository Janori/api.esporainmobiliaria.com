<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiLocation extends Model{
    
    protected $table = 'locations';

    protected $fillable = ['latitude', 'longitude'];

    public function lands(){
    	return $this->hasMany('App\Models\JiLand', 'location_id');
    }

    public function branches(){
    	return $this->hasMany('App\Models\JiBranch', 'location_id');
    }

}
