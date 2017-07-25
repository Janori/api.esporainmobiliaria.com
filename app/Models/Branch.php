<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';


    protected $fillable = ['name','location_id','user_id','extra_data'];

    public function location() {
        return $this->belongsTo('App\Models\Location');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
