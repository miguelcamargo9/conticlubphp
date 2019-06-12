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

}
