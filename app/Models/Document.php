<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    public function POwner(){
    	return $this->belongsTo('App\Models\Customer');
    }
}
