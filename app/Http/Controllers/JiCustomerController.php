<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\JiCustomer;
use App\Helpers\Response;

class JiCustomerController extends Controller
{
    
    public function options($option){
        switch ($option) {
            case 'gender':
                return Response::set(true, '', JiCustomer::$gender_options);
            case 'kind':
                return Response::set(true, '', JiCustomer::$kind_options);
            case 'mstatus':
                return Response::set(true, '', JiCustomer::$mstatus_options);
            default:
                return Response::set(false, 'Invalid option: ' . $option);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$customer = JiCustomer::create($request->all());
        $customer = JiCustomer::oJson($request);
        return '' . $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(is_null($id) || !is_numeric($id)) return Response::set(false, 'Error en la petición');
        $customer = JiCustomer::find($id);
        if($customer == null)
            return Response::set(false, 'User not found');
        else
            return Response::set(true, '', $customer);
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
        $customer = JiCustomer::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $customer->{$key} = $value;

        $customer->save();
        return Response::set(true, 'Se ha actualizado correctamente al cliente', $customer);
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
