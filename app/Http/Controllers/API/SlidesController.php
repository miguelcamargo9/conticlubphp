<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
//MODELOS
use App\Models\Slides;

class SlidesController extends BaseController {

  public function all() {
    $slides = Slides::all();
    return $slides;
  }

  public function create(Request $r) {
    
    //$infoProduct = json_decode($r->getContent(), true);
    $mainImage = $r->file('image');
    
    $newSlide = new Slides();
    $newSlide->path = "";
    
    if($newSlide->save()){
      $path = public_path()."/slides/";
      
      $nameSlideFile = "slide_{$newSlide->id}.{$mainImage->getClientOriginalExtension()}";
      $mainImage->move($path, "$nameSlideFile");
      //actualizar y guardar la imagen del registro
      $newSlide->path = "/slides/$nameSlideFile";
      $newSlide->update();
    
    }
    return ["message"=>"success"];
  }
  
   ///OBTENER UN SLIDE EXISTENTE
  public function get($id) {
    $slide = Slides::find($id);
    return $slide;
  }
  
  public function update($id){
    $slide = Slides::find($id);
    $slide->show = ($slide->show === 0) ? 1 : 0;
    $slide->save();
    return $slide;
  }
  
  //DELETE A SLIDE
  public function delete($id) {
    $slide = Slides::find($id);
    try {
      $slide->delete();
      return["message" => "success"];
    } catch (\Illuminate\Database\QueryException $e) {
      $error = $e->errorInfo;
      return ($error[0] == "23000") ? ["message" => "error", "detail" => "Este slide se esta usando en otros registros. Por favor verifique que este slide se pueda eliminar"] : ["message" => "error", "detail" => $error[2]];
    }
  }

}
