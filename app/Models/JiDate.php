<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiDate extends Model
{
    protected $table = 'dates';

    public function prospect(){
    	return $this->belongsTo('App\Models\JiProspect');
    }
    public function user(){
    	return $this->belongsTo('App\Models\JiUser');
    }
}
