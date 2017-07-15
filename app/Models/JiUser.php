<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiUser extends Model{

    protected $table = 'ji_users';

    protected $hidden = ['id', 'user_id', 'created_at', 'updated_at', 'user'];

    protected $appends = ['email'];

    public function getEmailAttribute(){
    	return $this->attributes['usr_ref'] = $this->user->email;
    }

    public function user(){
    	return $this->belongsTo('App\User');
		//return $this->hasOne('App\User');
	}	
}
