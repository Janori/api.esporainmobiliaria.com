<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    
    protected $table = 'buildings';

    protected $fillable = ['land_id','warehouse_id','office_id','house_id','extra_data'];
    	

    public function images(){
    	return $this->hasMany('App\Models\building_images');
    }
}
