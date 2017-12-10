<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{

    public static $gender_options = [
    	'Masculino' => 'm',
    	'Femenino' => 'f',
		'Sin definir' => 'x',
	];

	public static $kind_options = [
    	'Propietario' => 'o',
    	'Comprador' => 'b',
		'Prospecto' => 'p',
		'Sin definir' => 'x',
	];

	public static $mstatus_options = [
    	'Soltero' => 's',
    	'Casado' => 'm',
		'Viudo' => 'w',
		'Divorciado' => 'd',
	];

    protected $table = 'customers';


    protected $fillable = ['id', 'name', 'first_surname', 'last_surname', 'gender', 'mstatus', 'address', 'kind', 'email', 'user_id', 'file_path', 'created_at', 'updated_at'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function prospect() {
        return $this->hasOne('App\Models\Prospect');
    }

}
