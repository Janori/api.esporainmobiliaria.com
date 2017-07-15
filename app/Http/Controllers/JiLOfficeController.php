<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiOffice;

use App\Helpers\Response;

class JiLOfficeController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$office = JiOffice::create($request->all());
        $office = JiOffice::oJson($request);
        return '' . $office;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $office = JiOffice::find($id);
        if($office == null)
            return Response::set(false, 'Officina no encontrada');
        else
            return Response::set(true, '', $office);
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
        $office = JiOffice::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $office->{$key} = $value;

        $office->save();
        return Response::set(true, 'Se han actualizado correctamente los datos de la oficina', $office);
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


