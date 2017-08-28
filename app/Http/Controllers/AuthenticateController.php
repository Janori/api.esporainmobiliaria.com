<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\JiUser;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Helpers\JResponse;


class AuthenticateController extends Controller{

    private $expirationTime = 60;

    public function authenticate(Request $request){
        if($request->has('email')){
            $credentials = $request->only('email', 'password');
        }else{
            $credentials = $request->only('username', 'password');
        }
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(JResponse::set(false, 'invalid credentials')); //,401
            }
        }catch(JWTException $e){
            return response()->json(JResponse::set(false, 'could not create token')); //,500
        }
        return response()->json(
            JResponse::set(true,'Token successfully created', ['token' => $token,
                                                               'ttl' => $this->expirationTime,
                                                               'user' => JWTAuth::toUser($token)
                                                               ]));
    }

    public function register(Request $request){
        $user = new User($request->all());
        try {
            $user->save();
        } catch (\PDOException $e) {
            return response()->json(JResponse::set(true,'El usuario no se pudo crear.',$e->getMessage()));
        }
        return response()->json(JResponse::set(true,'Usuario creado correctamente.', $user->toArray()));
    }

    public function isLogged(Request $request){
        $auth = $request->header('Authorization');
        if(is_null($auth) || $auth == "") return response()->json(JResponse::set(true,'bool',false));
        $user = JWTAuth::toUser($auth);
        if($user) return response()->json(JResponse::set(true,'bool',true));
        return response()->json(JResponse::set(true,'bool',false));
    }

    public function getUserData(Request $request){
        $auth = $request->header('Authorization');
        if(is_null($auth) || $auth == "") return response()->json(JResponse::set(false,'Error en la petición.'));
        $user = JWTAuth::toUser($auth);
        if(!$user) return response()->json(JResponse::set(false,'No se obtuvieron datos de ningún usuario.'));
        return response()->json(JResponse::set(true,'bool',$user));
    }

    public static function getUserFromToken($token){
        $user = JWTAuth::toUser($token);
        return $user;
    }

    public function lockscreen(Request $request) {
        $auth = $request->header('Authorization');
        $user = JWTAuth::toUser($auth);

        $password = $request->input('password');
        $hashedPassword = $user->password;


        if (Hash::check($password, $hashedPassword)) {
			return response()->json(JResponse::set(true, null));
		}

        return response()->json(JResponse::set(false, 'Las contraseñas no coinciden'));

    }

}
