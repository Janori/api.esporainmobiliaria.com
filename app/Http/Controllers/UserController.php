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

    public function kinds(){
        $arr = [
            ['key'=>'a', 'value'=>'Administrador'],
            ['key'=>'u', 'value'=>'Agente'],
            ['key'=>'s', 'value'=>'Supervisor']
        ];
        return response()->json(JResponse::set(true, "", $arr));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return response()->json(JResponse::set(true, "", $users->toArray()));
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

    public function store(Request $request) {
        $user = User::create($request->all());
        return response()->json(JResponse::set(true, 'Usuario creado exitósamente.'));
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
        $user = User::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $user->{$key} = $value;

        $user->save();

        return response()->json(JResponse::set(true, 'Usuario editado exitósamente.'));
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

    public function getBranch($id = null){
        if(is_null($id) || !is_numeric($id))
            return response()->json(JResponse::set(false, 'Error en la petición'));
        $user = User::find($id);
        $branch = $user->branch;
        if(!is_null($branch)){
            return response()->json(JResponse::set(true, 'obj', $branch->toArray()));
        }return response()->json(JResponse::set(false, 'El usuario no tiene una sucursal'));
    }

    public function getTipo($tipo){
        if(strlen($tipo) > 1)
            return response()->json(JResponse::set(false, 'Error en la petición'));
        $users = User::where('kind','=',$tipo)->get();
        if($users->count() > 0){
            return response()->json(JResponse::set(true, 'obj', $users->toArray()));
        }return response()->json(JResponse::set(false, 'No se ha seleccionado un tipo válido.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::destroy($id);

        return response()->json(JResponse::set(true, 'El usuario ha sido eliminado'));
    }

    public function changePassword(Request $request, $id = null){
        $auth = $request->header('Authorization');
        if(is_null($auth) || empty($auth) || (!is_null($id) && !is_numeric($id)))
            return response()->json(JResponse::set(false,'Error en la petición.'));
        try{
            $user = JWTAuth::toUser($auth);
            if($id == null) $id = $user->id;
            $pass = $request->input('password');
            if(!($user->kind == "a" || $user->id == $id))
                return response()->json(JResponse::set(false,'El solicitante no puede cambiar la contraseña.'));


            if(is_null($pass) || empty($pass))
                return response()->json(JResponse::set(false,'La contraseña no puede estar vacia.'));
            else{
                $user = User::find($id);
                if($user == null)
                    return response()->json(JResponse::set(false,'Hubo un error al cambiar la contraseña.'));

                $user->password = $pass;
                $user->save();
                return response()->json(JResponse::set(true,'Contraseña guardada correctamente.'));
            }
        }catch(\Exception $ex){
            return response()->json(JResponse::set(false,'Hubo un error al cambiar la contraseña.'));
        }
    }
}


class Menus{

    public static $admin = [
        ['title' => 'Inicio', 'icon' => 'icon-rocket','url'=> ''],
        ['title' => 'Agentes', 'icon' => 'icon-users','url'=> 'agentes'],
        ['title' => 'Sucursales', 'icon' => 'icon-briefcase','url'=> 'sucursales'],
        ['title' => 'Inmuebles', 'icon' => 'icon-home','url'=> 'inmuebles'],
        // ['title' => 'Prospectos', 'icon' => 'icon-user-follow','url'=> 'prospectos'],
        // ['title' => 'Ventas', 'icon' => 'icon-bar-chart','url'=> 'ventas'],
        ['title' => 'Geolocalización', 'icon' => 'icon-pointer','url'=> 'geolocalizacion'],
        ['title' => 'Usuarios', 'icon' => 'icon-user-following','url'=> 'usuarios']
    ];


    public static $supervisor = [
        ['title'=> 'Inicio', 'icon'=> 'icon-rocket','url'=> ''],
        ['title'=> 'Agentes', 'icon'=> 'icon-users','url'=> 'agentes'],
        ['title'=> 'Inmuebles', 'icon'=> 'icon-home','url'=> 'inmuebles'],
        // ['title'=> 'Prospectos', 'icon'=> 'icon-user-follow','url'=> 'prospectos'],
        // ['title'=> 'Ventas', 'icon'=> 'icon-bar-chart','url'=> 'ventas'],
        ['title'=> 'Geolocalización', 'icon'=> 'icon-pointer','url'=> 'geolocalizacion']
    ];

    public static $agente = [
        ['title'=> 'Inicio', 'icon'=> 'icon-rocket','url'=> ''],
        ['title'=> 'Inmuebles', 'icon'=> 'icon-home','url'=> 'inmuebles'],
        // ['title'=> 'Prospectos', 'icon'=> 'icon-user-follow','url'=> 'prospectos'],
        ['title'=> 'Geolocalización', 'icon'=> 'icon-pointer','url'=> 'geolocalizacion']
    ];
}
