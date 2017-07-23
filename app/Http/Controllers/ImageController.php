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
    public function show($id){
    }

    public function upload(Request $request, $id = null) {
        /*$building = Building::find($id);
        $image = new BuildingImages();*/

        $file = $request->file('image');
        $mimeType = File::mimeType($file);
        $ext = $file->getClientOriginalExtension();
        $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $ext;
        $path = $path = public_path() . '/images/bld/' . $filename;
        try{
            Image::make($file->getRealPath())->save($path);   
        }catch(\Exception $ex){
            return response().json(JResponse::set(false, "No se pudo guardar la imagen.", $ex->getMessage()));
        }

        return ['path'=>$path, 'id'=>$id];
        /*$image->path = '/images/products/' . $filename;
        $image->mime = $mimeType;
        $image->save();
        $building->images()->attach($image->id);*/
        return response().json(JResponse::set(true, 'path', ['path'=> $path]));
    }

    public function destroy($id) {
        Image::destroy($id);
        return response()->json(array('status' => true, 'message' => 'Imagen eliminada correctamente'));
    }
}
