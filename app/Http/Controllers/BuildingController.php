<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiBuilding;

use App\Helpers\JResponse;

class JiBuildingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$building = JiBuilding::create($request->all());
        $building = Building::oJson($request);
        return '' . $building;
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
        $building = Building::find($id);
        if($building == null)
            return response()->json(JResponse::set(false, 'Edificio no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $building));
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
        $building = Building::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $building->{$key} = $value;

        $building->save();
        return response()->json(JResponse::set(true, 'Se ha actualizado correctamente el edificio', $building));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(is_null($id) || !is_numeric($id))
            return response()->json(return JResponse::set(false, 'Error en la petición'));
        return 'hi';
    }
}
