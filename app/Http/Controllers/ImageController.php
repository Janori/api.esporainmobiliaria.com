<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Building;
use App\Models\BuildingImages;
use App\Helpers\JResponse;

use File;
use Image;

class ImageController extends Controller{
    private $imagesPath = '/images/bld/';
    public function show($id){
    }

    public function upload(Request $request, $id = null) {
        if(is_null($id) || !is_numeric($id)) return response()->json(JResponse::set(false, 'Error en la petición'));
        $building = Building::find($id);
        if($building == null) return response()->json(JResponse::set(false, 'El inmueble no existe.'));
        $image = new BuildingImages();

        $file = $request->file('image');
        $mimeType = File::mimeType($file);
        $ext = $file->getClientOriginalExtension();
        $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $ext;
        $path = public_path() . $this->imagesPath . $filename;
        try{
            $imageFile = Image::make($file->getRealPath())->save($path);
            $imageFile->resize(240, 200);
            $imageFile->save(public_path() . $this->imagesPath . 'thumb_' . $filename);
        }catch(\Exception $ex){
            return response()->json(JResponse::set(false, "No se pudo guardar la imagen.", $ex->getMessage()));
        }
        $image->path = $filename;
        //$image->mime = $mimeType;
        $image->building_id = $id;
        $image->save();
        return response()->json(JResponse::set(true, 'path', ['path'=> $path]));
    }

    public function destroy($id) {
        BuildingImages::destroy($id);
        return response()->json(array('status' => true, 'message' => 'Imagen eliminada correctamente'));
    }
}
