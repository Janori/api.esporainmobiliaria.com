<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Date;

use App\Helpers\JResponse;

class DateController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$date = JiDate::create($request->all());
        $date = Date::oJson($request);
        return '' . $date;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return JResponse::set(false, 'Error en la petición');
        $date = Date::find($id);
        if($date == null)
            return response()->json(JResponse::set(false, 'Edificio no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $date));
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
        $date = Date::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $date->{$key} = $value;

        $date->save();
        return response()->json(JResponse::set(true, 'Se ha actualizado correctamente el edificio', $date));
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
