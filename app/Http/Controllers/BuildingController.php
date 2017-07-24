<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Land;
use App\Models\Warehouse;
use App\Models\Office;
use App\Models\Housing;

use App\Helpers\JResponse;

class BuildingController extends Controller
{

    public function index(){
        $buildings = Building::all();
        return response()->json(JResponse::set(true, "[obj]", $buildings->toArray()));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            \DB::connection()->getPdo()->beginTransaction();
            $land = Land::create($request->all()['land']);
            $warehouse = Warehouse::create($request->all()['warehouse']);
            $office = Office::create($request->all()['office']);
            $house = Housing::create($request->all()['house']);
            $building = Building::create([
                "land_id" => $land->id,
                "warehouse_id" => $warehouse->id,
                "house_id" => $house->id,
                "office_id" => $office->id,
                "extra_data" => $request->has('extra_data') ? $request->all()['extra_data'] : ""
            ]);
            \DB::connection()->getPdo()->commit();
            return response()->json(JResponse::set(true, '', $building->toArray()));
        } catch (\PDOException $e) {
            \DB::connection()->getPdo()->rollBack();
            return response()->json(JResponse::set(false, $e->getMessage()));
        }
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
        $building = Building::find($id);
        if($building == null)
            return response()->json(JResponse::set(false, 'Edificio no encontrado'));
        else
            return response()->json(JResponse::set(true, '', $building->toArray()));
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
        $building = Building::find($id);

        foreach ($request->all() as $key => $value)
            if(!is_null($value))
                $building->{$key} = $value;

        $building->save();
        return response()->json(JResponse::set(true, 'Se ha actualizado correctamente el edificio', $building));
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
