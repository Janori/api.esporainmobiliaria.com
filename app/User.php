<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'first_surname',
                           'last_surname', 'gender', 'mariage_status',
                           'address', 'kind', 'username', 'colonia', 'cp', 'municipio', 'estado', 'pais'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'branch'];

    protected $appends = ['sucursal'];

    protected $dates = ['created_at', 'updated_at'];

    public function setPasswordAttribute($value) {
        if(!empty($value))
            $this->attributes['password'] = bcrypt($value);
    }

    public function getSucursalAttribute(){
        return $this->branch;
    }

    public function getDates(){
        return array();
    }

    public function branch(){
        return $this->belongsTo('App\Models\Branch');
    }



}
