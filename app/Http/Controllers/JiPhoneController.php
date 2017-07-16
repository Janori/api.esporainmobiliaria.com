<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiPhone;

use App\Helpers\JResponse;

class JiPhoneController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$phone = JiPhone::create($request->all());
        $phone = JiPhone::oJson($request);
        return '' . $phone;
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
        $phone = JiPhone::find($id);
        if($phone == null)
            return response()->json(JResponse::set(false, 'Telefono no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $phone));
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
        $phone = JiPhone::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $phone->{$key} = $value;

        $phone->save();
        return response()->json(JResponse::set(true, 'Se han actualizado correctamente los datos del teléfono', $phone));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(is_null($id) || !is_numeric($id)) 
            return response()->json(JResponse::set(false, 'Error en la petición'));
        return 'hi';
    }
}


