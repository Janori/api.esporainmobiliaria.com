<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Prospect;
use App\Models\Building;
use App\Helpers\JResponse;

use File;
use Image;
use Mail;

class CustomerController extends Controller
{

    public function options($option){
        switch ($option) {
            case 'gender':
                return response()->json(JResponse::set(true, '', Customer::$gender_options));
            case 'kind':
                return response()->json(JResponse::set(true, '', Customer::$kind_options));
            case 'mstatus':
                return response()->json(JResponse::set(true, '', Customer::$mstatus_options));
            default:
                return response()->json(JResponse::set(false, 'Invalid option: ' . $option));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type){
        if($type == 'prospects')
            return $this->prospects();

        return $this->owners();
    }

    public function prospects() {
        $prospects = Customer::where('kind', 'p')->get();
        return response()->json(JResponse::set(true, "", $prospects->toArray()));
    }

    public function owners() {
        $prospects = Customer::where('kind', 'o')->get();
        return response()->json(JResponse::set(true, "", $prospects->toArray()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $customer = Customer::create($request->all());

            if($customer->kind == 'p') {
                if(is_null($customer->prospect)) {
                    $prospect = new Prospect();
                    $prospect->customer_id = $customer->id;
                } else {
                    $prospect = $customer->prospect;
                }


                foreach($request->input('prospect') as $key => $value)
                    if(!is_array($value))
                        $prospect->{$key} = $value;

                $prospect->save();
            }
            return response()->json(true, 'Registro añadido correctamente el registro');
        } catch(\Exception $e) {
            return response()->json(false, $e->getMessage());
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
        $customer = Customer::with('prospect', 'prospect.building', 'prospect.user')->findOrFail($id);
        if(is_null($customer))
            return response()->json(JResponse::set(false, 'User not found'));
        else
            return response()->json(JResponse::set(true, null, compact('customer')));
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
        $customer = Customer::find($id);

        foreach ($request->except('prospect') as $key => $value)
            if(!is_null($value))
                $customer->{$key} = $value;

        $customer->save();

        if($customer->kind == 'p') {
            if(is_null($customer->prospect)) {
                $prospect = new Prospect();
                $prospect->customer_id = $customer->id;
            } else {
                $prospect = $customer->prospect;
            }


            foreach($request->input('prospect') as $key => $value)
                if(!is_array($value))
                    $prospect->{$key} = $value;

            $prospect->save();
        }

        return response()->json(JResponse::set(true, 'Se ha actualizado correctamente el registro', $customer));
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

    public function file(Request $request, $id) {
        $file = $request->file('file');

        $customer = Customer::find($id);

        $mimeType = File::mimeType($file);
        $ext = $file->getClientOriginalExtension();
        $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $ext;
        $path = base_path() . '/customer/';
        $path = str_replace('laravel/', '', $path);

        try {
            $file->move($path, $filename);
            $customer->file_path = $filename;
            $customer->save();
            return response()->json(JResponse::set(true, 'Archivo cargado al servidor con éxito'));
        } catch(\Exception $ex){
            return response()->json(JResponse::set(false, "No se pudo guardar la imagen.", $ex->getMessage()));
        }

    }

    public function prospectsInteresteds(Request $request) {
        $kind = $request->input('kind');
        $customers = Customer::whereHas('prospect', function($query) use ($kind){
            $query->whereIn('building_id', function($query) use ($kind) {
                $query->select('id')
                      ->from(with(new Building)->getTable())
                      ->where('type', $kind);
            });
        })->get();

        $buildings = Building::where('type', $kind)->get();

        return response()->json(JResponse::set(true, null, compact('customers', 'buildings')));
    }

    public function campaign(Request $request) {
        $customers = $request->input('customers');
        $buildings = $request->input('Building');

        foreach($customers as &$customers) {

        }

        $email    = $request->input('email');
        Mail::send('emails.campaign', ['building' => $building], function ($m) use ($email) {
           $m->from('no-reply@esporainmobiliaria.com', 'Espora Inmobiliaria');

           $m->to($email)->subject('Ficha Técnica de Imueble');
       });

       if(count(Mail::failures()) > 0)
         return response()->json(JResponse::set(false, 'Hubo un error al enviar el correo'));
        else
        return response()->json(JResponse::set(true, 'Correo enviado con éxito'));

    }

    public function mailtest() {

        return view('emails.campagin');
        Mail::send('emails.campagin', [], function ($m) {
           $m->from('no-reply@esporainmobiliaria.com', 'Espora Inmobiliaria');

           $m->to('esandoval@janori.com')->subject('8=====D');
       });

       if(count(Mail::failures()) > 0)
         return response()->json(JResponse::set(false, 'Hubo un error al enviar el correo'));
        else
        return response()->json(JResponse::set(true, 'Correo enviado con éxito'));

    }
}
