<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Controllers\AuthenticateController;
use App\User;
use App\Models\Building;
use App\Helpers\JResponse;

use JWTAuth;

class UserController extends Controller
{

    public function kinds(){
        $arr = [
            ['key'=>'a', 'value'=>'Administrador'],
            ['key'=>'u', 'value'=>'Agente'],
            ['key'=>'s', 'value'=>'Gerente'],
            ['key'=>'p', 'value'=>'Partner']
        ];
        return response()->json(JResponse::set(true, "", $arr));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $auth = $request->header('Authorization');
        $user = JWTAuth::toUser($auth);

        if($user->kind == 'a') {
            $users = User::where('kind', 'p')->get();
            // foreach($users as $user)
                // dd($user->password);
        }
        else
            $users = User::whereNotIn('kind', ['a'])->get();

        return response()->json(JResponse::set(true, "", compact('users')));
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

        $user->fill($request->all());
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
            case 'p':
                return response()->json(JResponse::set(true,'array', Menus::$partner));
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

    public function files(Request $request, $user_id, $type) {
        var_dump($request);
        var_dump($user_id);
        var_dump($type);
        die;
    }

    private function getStartAndEndDate($week, $year) {
        $dto = new \DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
    }


    public function home() {

        $dateLimits = $this->getStartAndEndDate(date('W'), date('Y'));
        $expiredDate = date('Y-m-d', strtotime('-75 days'));

        $gcNewBuildings = [
            'data' => Building::where('created_at', '>=', $dateLimits['week_start'])
                               ->where('created_at', '<=', $dateLimits['week_end'])->with('land', 'warehouse', 'office', 'house', 'images')->get()
        ];

        $gcActiveBuildings = [
            'data' => Building::whereNull('customer_id')->with('land', 'warehouse', 'office', 'house', 'images')->get()
        ];
        $gcSoldBuildings = [
            'data' => Building::whereNotNull('customer_id')
                               ->where('updated_at', '>=', $dateLimits['week_start'])
                               ->where('updated_at', '<=', $dateLimits['week_end'])->with('land', 'warehouse', 'office', 'house', 'images')->get()
        ];

        $gcExpiredBuildings = [
            'data' => Building::whereNull('customer_id')
                               ->where('created_at', '<', $expiredDate)->with('land', 'warehouse', 'office', 'house', 'images')->get()
        ];

        $gcNewBuildings['value']     = count($gcNewBuildings    ['data']);
        $gcActiveBuildings['value']  = count($gcActiveBuildings ['data']);
        $gcSoldBuildings['value']    = count($gcSoldBuildings   ['data']);
        $gcExpiredBuildings['value'] = count($gcExpiredBuildings['data']);


        return compact('gcNewBuildings',
        'gcActiveBuildings',
        'gcSoldBuildings',
        'gcExpiredBuildings');
    }
}


class Menus {

    public static $admin = [
        ['title' => 'Inicio', 'icon' => 'icon-rocket','url'=> ''],
        ['title' => 'Partners', 'icon' => 'icon-users','url'=> 'usuarios'],
        ['title' => 'Inmuebles', 'icon' => 'icon-home','url'=> 'inmuebles'],
        ['title' => 'Estadísticas', 'icon' => 'icon-bar-chart','url'=> 'ventas'],
        ['title' => 'Geolocalización', 'icon' => 'icon-pointer','url'=> 'geolocalizacion'],
    ];

    public static $partner = [
        ['title' => 'Inicio', 'icon' => 'icon-rocket','url'=> ''],
        // ['title' => 'Agentes', 'icon' => 'icon-users','url'=> 'agentes'],
        ['title' => 'Sucursales', 'icon' => 'icon-briefcase','url'=> 'sucursales'],
        ['title' => 'Inmuebles', 'icon' => 'icon-home','url'=> 'inmuebles'],
        ['title' => 'Prospectos', 'icon' => 'icon-user-follow','url'=> 'prospectos'],
        ['title' => 'Propietarios', 'icon' => 'icon-key','url'=> 'propietarios'],
        ['title' => 'Estadísticas', 'icon' => 'icon-bar-chart','url'=> 'ventas'],
        ['title' => 'Geolocalización', 'icon' => 'icon-pointer','url'=> 'geolocalizacion'],
        ['title' => 'Usuarios', 'icon' => 'icon-user-following','url'=> 'usuarios'],
        ['title' => 'Campañas', 'icon' => 'icon-envelope','url'=> 'campanias']
    ];

    public static $supervisor = [
        ['title'=> 'Inicio', 'icon'=> 'icon-rocket','url'=> ''],
        // ['title'=> 'Agentes', 'icon'=> 'icon-users','url'=> 'agentes'],
        ['title'=> 'Inmuebles', 'icon'=> 'icon-home','url'=> 'inmuebles'],
        ['title'=> 'Prospectos', 'icon'=> 'icon-user-follow','url'=> 'prospectos'],
        ['title'=> 'Propietarios', 'icon'=> 'icon-key','url'=> 'propietarios'],
        ['title'=> 'Estadísticas', 'icon'=> 'icon-bar-chart','url'=> 'ventas'],
        ['title'=> 'Geolocalización', 'icon'=> 'icon-pointer','url'=> 'geolocalizacion'],
        ['title'=> 'Campañas', 'icon'=> 'icon-envelope','url'=> 'campanias']
    ];

    public static $agente = [
        ['title'=> 'Inicio', 'icon'=> 'icon-rocket','url'=> ''],
        ['title'=> 'Inmuebles', 'icon'=> 'icon-home','url'=> 'inmuebles'],
        ['title'=> 'Prospectos', 'icon'=> 'icon-user-follow','url'=> 'prospectos'],
        ['title'=> 'Propietarios', 'icon'=> 'icon-key','url'=> 'propietarios'],
        ['title'=> 'Geolocalización', 'icon'=> 'icon-pointer','url'=> 'geolocalizacion'],
        ['title'=> 'Campañas', 'icon'=> 'icon-envelope','url'=> 'campanias']
    ];
}
