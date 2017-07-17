<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Helpers\JResponse;


class AuthenticateController extends Controller{

    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(JResponse::set(false, 'invalid credentials')); //,401
            }
        }catch(JWTException $e){
            return response()->json(JResponse::set(false, 'could not create token')); //,500
        }
        return response()->json(JResponse::set(true,'Token successfully created', compact('token')));
    }

    public function register(Request $request){
        $user = User::create([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password'))
        ]);
        return response()->json(JResponse::set(true,'User created successfully',$user));
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

}







