<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    
    protected $table = 'buildings';

    protected $fillable = ['land_id','warehouse_id','office_id','house_id','extra_data'];
    
    protected $appends = ['lands', 'warehouses', 'offices', 'houses', 'image'];

    protected $hidden = ['land', 'warehouse', 'office', 'house', 'images'];

    public function images(){
    	return $this->hasMany('App\Models\BuildingImages');
    }

    public function getImageAttribute(){
        return $this->images;
    }

    public function getLandsAttribute(){
    	return $this->land;
    }
    public function getWarehousesAttribute(){
    	return $this->warehouse;
    }
    public function getOfficesAttribute(){
    	return $this->office;
    }
    public function getHousesAttribute(){
    	return $this->house;
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


}
