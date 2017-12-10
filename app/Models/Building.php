<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    protected $table = 'buildings';

    protected $fillable = ['land_id','warehouse_id','office_id','house_id','extra_data', 'type'];

    public function images(){
    	return $this->hasMany('App\Models\BuildingImages');
    }

    public function land(){
    	return $this->belongsTo('App\Models\Land');
    }
    public function warehouse(){
    	return $this->belongsTo('App\Models\Warehouse');
    }
    public function office(){
    	return $this->belongsTo('App\Models\Office');
    }
    public function house(){
    	return $this->belongsTo('App\Models\Housing');
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
