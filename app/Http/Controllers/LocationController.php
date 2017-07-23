<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Location;

use App\Helpers\JResponse;

class LocationController extends Controller{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$location = JiLocation::create($request->all());
        $location = Location::oJson($request);
        return '' . $location;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) 
            return response()->json(Response::set(false, 'Error en la petición'));
        $location = Location::find($id);
        if($location == null)
            return response()->json(Response::set(false, 'Location not found'));
        else
            return response()->json(Response::set(true, '', $location));
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
            return response()->json(Response::set(false, 'Error en la petición'));
        $location = Location::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $location->{$key} = $value;

        $location->save();
        return response()->json(Response::set(true, 'Se ha actualizado correctamente la ubicacion', $location));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(is_null($id) || !is_numeric($id)) 
            return response()->json(Response::set(false, 'Error en la petición'));
        return 'hi';
    }
}
