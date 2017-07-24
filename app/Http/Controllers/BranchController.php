<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Branch;

use App\Helpers\JResponse;

class BranchController extends Controller{

    public function users($id){
        if(is_null($id) || !is_numeric($id)) 
            return response()->json(JResponse::set(false, 'Error en la petición.'));
        $branch = Branch::find($id);
        if($branch == null)
            return response()->json(JResponse::set(false, 'Sucursal no encontrada.'));
        else{
            $users = $branch->users;
            if($users->count() > 0){    
                return response()->json(JResponse::set(true, 'obj', $users->toArray()));
            }return response()->json(JResponse::set(false, 'La sucursal no tiene usuarios registrados.'));
        }

    }

    public function index(){
        $branches = Branch::all();
        return response()->json(JResponse::set(true, "[obj]", $branches->toArray()));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $branch = Branch::create($request->all());
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
            return response()->json(JResponse::set(false, 'Sucursal no encontrada'));
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
        try{
            $branch->save();
            return response()->json(JResponse::set(true, 'object', $branch));   
        }catch(\Exception $ex){
            return response()->json(JResponse::set(false, 'Ocurrió un error al actualizar la sucursal'));
        }
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
