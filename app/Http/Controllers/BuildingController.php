<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Building;
use App\Models\Land;
use App\Models\Warehouse;
use App\Models\Office;
use App\Models\Housing;
use App\Models\Sale;

use App\Helpers\JResponse;

use Mail;

class BuildingController extends Controller
{

    public function index(){
        $buildings = Building::with('land', 'warehouse', 'office', 'house', 'images')->whereNull('customer_id')->get();
        return response()->json(JResponse::set(true, null, $buildings->toArray()));
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
            $location = Location::create($request->input('land')['location']);
            $landData = $request->input('land');
            unset($landData['location']);
            $landData['location_id'] = $location->id;
            $land = new Land(
                $landData
            );
            $land->save();
            if($request->has('warehouse'))
            $warehouse = Warehouse::create($request->all()['warehouse']);
            if($request->has('office'))
            $office = Office::create($request->all()['office']);
            if($request->has('house'))
            $house = Housing::create($request->all()['house']);
            $building = Building::create([
                "land_id" => $land->id,
                "warehouse_id" => $request->has('warehouse') ? $warehouse->id : null,
                "house_id" => $request->has('house') ? $house->id : null,
                "office_id" => $request->has('office') ? $office->id : null,
                "extra_data" => $request->has('extra_data') ? $request->all()['extra_data'] : "",
                'type' => $request->input('type'),
                'address'  => $request->input('address'),
                'customer_id'  => $request->input('customer_id'),
                'user_id'  => $request->input('user_id'),
            ]);
            \DB::connection()->getPdo()->commit();
            return response()->json(JResponse::set(true, 'Inmueble creado correctamente', $building->toArray()));
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
        $building = Building::where('id', $id)->with('land', 'land.location', 'warehouse', 'office', 'house', 'images', 'customer', 'user')->first();
        $extra_data = DB::table('sales')->where('id', $id)->where('customer_id', $building->customer_id)->first();
        $extra_data = $extra_data->extra_data;

        $building->sale = $extra_data;
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
        // dd($request->all());
        if(is_null($id) || !is_numeric($id))
            return response()->json(JResponse::set(false, 'Error en la petición'));
        $building = Building::find($id);

        $building->type = $request->input('type');
        $building->type = $request->input('type');
        $building->address = $request->input('address');
        $building->customer_id = $request->input('customer_id');
        $building->user_id = $request->input('user_id');

        $location = Location::find($request->input('land')['location_id']);
        $location->latitude = $request->input('land')['location']['latitude'];
        $location->longitude = $request->input('land')['location']['longitude'];
        $location->save();

        foreach ($request->input('land') as $key => $value) {
            if(in_array($key, ['location', 'location_id']))
                continue;

            $building->land{$key} = $value;
        }
        $building->land->save();

        if($request->input('warehouse_id') == null)
            $building->warehouse()->dissociate();

        if($request->input('office_id') == null)
            $building->office()->dissociate();

        if($request->input('house_id') == null)
            $building->house()->dissociate();

        if($request->has('warehouse') && $request->input('warehouse_id') != null) {
            if($building->warehouse == null) {
                $warehouse = Warehouse::create($request->all()['warehouse']);
                $building->warehouse()->associate($warehouse);
            }
            else {
                $warehouse = Warehouse::find($request->input('warehouse_id'));
                foreach ($request->input('warehouse') as $key => $value) {
                    $warehouse->{$key} = $value;
                }

                $warehouse->save();
            }
        }

        if($request->has('office') && $request->input('office_id') != null) {
            if($building->office == null) {
                $office = Office::create($request->all()['office']);
                $building->office()->associate($office);
            }
            else {
                $office = Office::find($request->input('office_id'));
                foreach ($request->input('office') as $key => $value) {
                    $office->{$key} = $value;
                }

                $office->save();
            }
        }

        if($request->has('house') && $request->input('house_id') != null) {
            if($building->house == null) {
                $house = Housing::create($request->all()['house']);
                $building->house()->associate($house);
            }
            else {
                $house = Housing::find($request->input('house_id'));
                foreach ($request->input('house') as $key => $value) {
                    $house->{$key} = $value;
                }

                $house->save();
            }
        }


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
        Building::destroy($id);
        return response()->json(JResponse::set(true, 'Inmueble eliminado correctamente'));
    }

    public function filter(Request $request) {

        $buildings = DB::table(with(new Building)->getTable())
                       ->leftJoin(with(new Land)->getTable(), 'buildings.land_id', '=', 'lands.id')
                       ->leftJoin(with(new Warehouse)->getTable(), 'buildings.warehouse_id', '=', 'warehouses.id')
                       ->leftJoin(with(new Office)->getTable(), 'buildings.office_id', '=', 'offices.id')
                       ->leftJoin(with(new Housing)->getTable(), 'buildings.house_id', '=', 'housings.id')
                       ->where('type', $request->input('type'))
                       ->where('for_sale', $request->input('disponibility') == 'Venta' ? 1 : 0)
                       ->whereBetween('price', [$request->input('price')['from'], $request->input('price')['to']])
                       ->whereBetween('surface', [$request->input('surface')['from'], $request->input('surface')['to']])
                       ->whereBetween('baths', [$request->input('baths')['from'], $request->input('baths')['to']])
                       ->whereBetween('rooms', [$request->input('rooms')['from'], $request->input('rooms')['to']])
                       ->select('buildings.*', 'lands.for_sale', 'lands.price', 'lands.surface')->get();

        return response()->json(JResponse::set(true, null, $buildings));
    }

    public function send(Request $request) {
        $building = Building::with('land', 'land.location', 'warehouse', 'office', 'house', 'images')->findOrFail($request->input('building_id'));
        $email    = $request->input('email');

        // return view('emails.building', ['building' => $building]);
        Mail::send('emails.building', ['building' => $building], function ($m) use ($email) {
           $m->from('no-reply@esporainmobiliaria.com', 'Espora Inmobiliaria');

           $m->to($email)->subject('Ficha Técnica de Imueble');
       });

       if(count(Mail::failures()) > 0)
         return response()->json(JResponse::set(false, 'Hubo un error al enviar el correo'));
        else
        return response()->json(JResponse::set(true, 'Correo enviado con éxito'));
    }

    public function sell(Request $request) {
        $sale = Sale::create($request->all());

        $building = Building::findOrFail($request->input('building_id'));
        $building->customer_id = $sale->customer_id;
        $building->save();

        return response()->json(JResponse::set(true, 'Venta realizada con éxito'));
    }

    public function removeCustomer($id) {
        $building = Building::findOrFail($id);

        $building->customer()->dissociate();
        $building->save();

        return response()->json(JResponse::set(true, 'Venta anulada con éxito'));
    }

    public function zipSearch($zipCode) {
        return response()->json(JResponse::set(true, 'No se han registrado ventas con este CP'));
    }
}
