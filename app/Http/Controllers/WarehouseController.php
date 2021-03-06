<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;

use App\Helpers\Response;

class WarehouseController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$wharehouse = JiWharehouse::create($request->all());
        $wharehouse = Wharehouse::oJson($request);
        return '' . $wharehouse;
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
        $wharehouse = Wharehouse::find($id);
        if($wharehouse == null)
            return response()->json(JResponse::set(false, 'Bodega no encontrada'));
        else
            return response()->json(JResponse::set(true, '', $wharehouse));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(is_null($id) || !is_numeric($id)) return JResponse::set(false, 'Error en la petición');
        $wharehouse = Wharehouse::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $wharehouse->{$key} = $value;

        $wharehouse->save();
        return response()->json(JResponse::set(true, 'Se han actualizado correctamente los datos de la bodega', $wharehouse));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(is_null($id) || !is_numeric($id)) return JResponse::set(false, 'Error en la petición');
        return 'hi';
    }
}


