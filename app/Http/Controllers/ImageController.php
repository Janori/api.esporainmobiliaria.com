<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Building;
use App\Models\BuildingImages;

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
        $path = $path = public_path() . '/images/products/' . $filename;
        try{
            Image::make($file->getRealPath())->save($path);   
        }catch(\Exception $ex){
            return $ex;
        }

        return ['path'=>$path, 'id'=>$id];
        /*$image->path = '/images/products/' . $filename;
        $image->mime = $mimeType;
        $image->save();
        $building->images()->attach($image->id);*/
    }

    public function destroy($id) {
        Image::destroy($id);
        return response()->json(array('status' => true, 'message' => 'Imagen eliminada correctamente'));
    }
}
