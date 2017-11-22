<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Prospect;
use App\Models\Customer;

use App\Helpers\JResponse;

class ProspectController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$prospect = JiProspect::create($request->all());
        $prospect = Prospect::oJson($request);
        return '' . $prospect;
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
        $prospect = Prospect::find($id);
        if($prospect == null)
            return response()->json(JResponse::set(false, 'Prospecto no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $prospect));
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
        $prospect = Prospect::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $prospect->{$key} = $value;

        $prospect->save();
        return response()->json(JResponse::set(true, 'Se han actualizado correctamente los datos del prospecto', $prospect));
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
