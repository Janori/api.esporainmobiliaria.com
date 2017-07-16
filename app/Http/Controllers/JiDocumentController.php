<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JiDocument;

use App\Helpers\JResponse;

class JiDocumentController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$document = JiDocument::create($request->all());
        $document = JiDocument::oJson($request);
        return '' . $document;
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
        $document = JiDocument::find($id);
        if($document == null)
            return response()->json(JResponse::set(false, 'Edificio no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $document));
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
        $document = JiDocument::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $document->{$key} = $value;

        $document->save();
        return response()->json(JResponse::set(true, 'Se ha actualizado correctamente el edificio', $document));
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


