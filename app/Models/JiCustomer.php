<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JiCustomer extends Model{

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
    
    protected $table = 'ji_customers';


    protected $fillable = ['fname', 'flname', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\Models\JiUser');
    }

}


















