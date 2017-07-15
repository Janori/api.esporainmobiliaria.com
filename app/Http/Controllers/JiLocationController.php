<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiLocation;

use App\Helpers\Response;

class JiLocationController extends Controller{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$location = JiLocation::create($request->all());
        $location = JiLocation::oJson($request);
        return '' . $location;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $location = JiLocation::find($id);
        if($location == null)
            return Response::set(false, 'Location not found');
        else
            return Response::set(true, '', $location);
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
        $location = JiLocation::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $location->{$key} = $value;

        $location->save();
        return Response::set(true, 'Se ha actualizado correctamente la ubicacion', $location);
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