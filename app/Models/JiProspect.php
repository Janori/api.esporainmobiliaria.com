<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiProspect extends Model
{
    protected $table = 'ji_prospects';

    public function building(){
    	return $this->belongsTo('App\Models\JiBuilding');
    }
    public function customer(){
    	return $this->belongsTo('App\Models\JiCustomer');
    }
    public function user(){
    	return $this->belongsTo('App\Models\JiUser');
    }
}
