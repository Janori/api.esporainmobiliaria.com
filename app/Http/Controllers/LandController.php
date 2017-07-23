<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Land;

use App\Helpers\JResponse;

class LandController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$land = JiLand::create($request->all());
        $land = Land::oJson($request);
        return '' . $land;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return response()->json(JResponse::set(false, 'Error en la petición'));
        $land = Land::find($id);
        if($land == null)
            return response()->json(JResponse::set(false, 'Terreno no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $land));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(is_null($id) || !is_numeric($id)) return response()->json(JResponse::set(false, 'Error en la petición'));
        $land = Land::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $land->{$key} = $value;

        $land->save();
        return response()->json(JResponse::set(true, 'Se han actualizado correctamente los datos del terreno', $land));
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


