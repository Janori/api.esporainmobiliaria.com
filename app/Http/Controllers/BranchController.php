<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Branch;

use App\Helpers\JResponse;

class BranchController extends Controller{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$branch = JiBranch::create($request->all());
        $branch = Branch::oJson($request);
        return '' . $branch;
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
        $branch = Branch::find($id);
        if($branch == null)
            return response()->json(JResponse::set(false, 'Location not found'));
        else
            return response()->json(JResponse::set(true, '', $branch));
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
        $branch = Branch::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $branch->{$key} = $value;

        $branch->save();
        return response()->json(JResponse::set(true, 'Se ha actualizado correctamente la ubicacion', $branch));
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
