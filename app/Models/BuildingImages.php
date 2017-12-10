<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildingImages extends Model
{
    
    protected $table = 'building_images';

    protected $fillable = ['building_id', 'path'];

    public $timestamps = false;

    public function building(){
    	$this->belongsTo('App\Models\Building');
    }

}
