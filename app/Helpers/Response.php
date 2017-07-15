<?php

namespace App\Helpers;

class Response{
	
	public static function set($status, $msg, $data = null){
		$response = array('status'=>$status, 'msg'=>$msg, 'data'=>$data);
		return json_encode($response);
	}
	
}