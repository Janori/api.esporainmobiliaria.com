<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Office;

use App\Helpers\JResponse;

class LOfficeController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$office = JiOffice::create($request->all());
        $office = Office::oJson($request);
        return '' . $office;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return response()->json(JResponse::set(false, 'Error en la petición'));
        $office = Office::find($id);
        if($office == null)
            return response()->json(JResponse::set(false, 'Officina no encontrada'));
        else
            return response()->json(JResponse::set(true, '', $office));
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
        $office = Office::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $office->{$key} = $value;

        $office->save();
        return response()->json(JResponse::set(true, 'Se han actualizado correctamente los datos de la oficina', $office));
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


