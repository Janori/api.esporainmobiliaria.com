<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';


    protected $fillable = ['name','location_id','user_id','extra_data'];

    public function users(){
        return $this->hasMany('App\Users');
    }
}
