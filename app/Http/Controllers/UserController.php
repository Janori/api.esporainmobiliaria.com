<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Controllers\AuthenticateController;
use App\User;
use App\Helpers\JResponse;

use JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $values = '';
        foreach ($users as $user) {
            $values .= $user->fname . '-';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) 
            return response()->json(JResponse::set(false, 'Error en la petición'));
        $users = User::find($id);
        return response()->json(JResponse::set(true, "", $users->toArray()));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(is_null($id) || !is_numeric($id)) 
            return response()->json(JResponse::set(false, 'Error en la petición'));
        $sale = User::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $sale->{$key} = $value;

        $sale->save();
    }

    public function getMenu(Request $request){
        $auth = $request->header('Authorization');
        if(is_null($auth) || $auth == "") return response()->json(JResponse::set(false,'Error en la petición.'));
        $user = JWTAuth::toUser($auth);
        if(is_null($user)) return response()->json(JResponse::set(false,'Token incorrecto.'));
        switch ($user->kind) {
            case 'a':
                return response()->json(JResponse::set(true,'array', Menus::$admin));
            case 'u':
                return response()->json(JResponse::set(true,'array', Menus::$agente));
            case 's':
                return response()->json(JResponse::set(true,'array', Menus::$supervisor));
            default:
                return response()->json(JResponse::set(false,'El usuario no tiene un tipo definido'));
        }
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


class Menus{

    public static $admin = [ 
        ['title' => 'Inicio', 'icon' => 'icon-rocket','url'=> ''],
        ['title' => 'Agentes', 'icon' => 'icon-users','url'=> 'agentes'],
        ['title' => 'Sucursales', 'icon' => 'icon-briefcase','url'=> 'sucursales'],
        ['title' => 'Inmuebles', 'icon' => 'icon-home','url'=> 'inmuebles'],
        ['title' => 'Prospectos', 'icon' => 'icon-user-follow','url'=> 'prospectos'],
        ['title' => 'Ventas', 'icon' => 'icon-bar-chart','url'=> 'ventas'],
        ['title' => 'Geolocalización', 'icon' => 'icon-pointer','url'=> 'geolocalización']
    ];


    public static $supervisor = [ 
        ['title'=> 'Inicio', 'icon'=> 'icon-rocket','url'=> ''],
        ['title'=> 'Agentes', 'icon'=> 'icon-users','url'=> 'agentes'],
        ['title'=> 'Inmuebles', 'icon'=> 'icon-home','url'=> 'inmuebles'],
        ['title'=> 'Prospectos', 'icon'=> 'icon-user-follow','url'=> 'prospectos'],
        ['title'=> 'Ventas', 'icon'=> 'icon-bar-chart','url'=> 'ventas'],
        ['title'=> 'Geolocalización', 'icon'=> 'icon-pointer','url'=> 'geolocalización']
    ];

    public static $agente = [ 
        ['title'=> 'Inicio', 'icon'=> 'icon-rocket','url'=> ''],
        ['title'=> 'Inmuebles', 'icon'=> 'icon-home','url'=> 'inmuebles'],
        ['title'=> 'Prospectos', 'icon'=> 'icon-user-follow','url'=> 'prospectos'],
        ['title'=> 'Geolocalización', 'icon'=> 'icon-pointer','url'=> 'geolocalización']
    ];
}











