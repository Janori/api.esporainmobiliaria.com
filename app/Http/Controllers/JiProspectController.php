<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiProspect;

use App\Helpers\Response;

class JiProspectController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$prospect = JiProspect::create($request->all());
        $prospect = JiProspect::oJson($request);
        return '' . $prospect;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $prospect = JiProspect::find($id);
        if($prospect == null)
            return Response::set(false, 'Prospecto no encontrado');
        else
            return Response::set(true, '', $prospect);
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
        $prospect = JiProspect::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $prospect->{$key} = $value;

        $prospect->save();
        return Response::set(true, 'Se han actualizado correctamente los datos del prospecto', $prospect);
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


