<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiDocument extends Model
{
    protected $table = 'ji_documents';

    public function POwner(){
    	return $this->belongsTo('App\Models\JiCustomer');
    }
}