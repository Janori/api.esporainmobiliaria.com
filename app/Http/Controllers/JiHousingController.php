<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiHousing;

use App\Helpers\Response;

class JiHousingController extends Controller{ 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$housing = Jihousing::create($request->all());
        $housing = Jihousing::oJson($request);
        return '' . $housing;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $housing = Jihousing::find($id);
        if($housing == null)
            return Response::set(false, 'Casa no encontrada');
        else
            return Response::set(true, '', $housing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $housing = Jihousing::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $housing->{$key} = $value;

        $housing->save();
        return Response::set(true, 'Se han actualizado correctamente los datos de la casa', $housing);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        return 'hi';
    }
}


