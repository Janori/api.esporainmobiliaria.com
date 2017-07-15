<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiDate;

use App\Helpers\Response;

class JiDateController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$date = JiDate::create($request->all());
        $date = JiDate::oJson($request);
        return '' . $date;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $date = JiDate::find($id);
        if($date == null)
            return Response::set(false, 'Edificio no encontrado');
        else
            return Response::set(true, '', $date);
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
        $date = JiDate::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $date->{$key} = $value;

        $date->save();
        return Response::set(true, 'Se ha actualizado correctamente el edificio', $date);
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