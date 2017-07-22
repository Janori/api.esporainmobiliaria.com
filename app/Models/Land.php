<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    protected $table = 'lands';

    public function land(){
    	return $this->belongsTo('App\Models\Land');
    }
}
