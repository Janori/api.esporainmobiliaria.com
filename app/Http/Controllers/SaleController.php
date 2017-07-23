<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Sale;

use App\Helpers\JResponse;

class SaleController extends Controller{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //$sale = JiSale::create($request->all());
        $sale = Sale::oJson($request);
        return '' . $sale;
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
        $sale = Sale::find($id);
        if($sale == null)
            return response()->json(JResponse::set(false, 'Venta no encontrada'));
        else
            return response()->json(JResponse::set(true, '', $sale));
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
        $sale = Sale::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $sale->{$key} = $value;

        $sale->save();
        return response()->json(JResponse::set(true, 'Se han actualizado correctamente los datos de la venta', $sale));
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


