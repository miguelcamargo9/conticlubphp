<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//MODELOS
use App\Models\Slides;

class SlidesController extends BaseController {

  public function all() {
    $slides = Slides::all();
    return $slides;
  }

  public function create(Request $r) {

    $infoSlide = json_decode(Input::post("data"), true);
    $mainImage = $r->file('image');

    $newSlide = new Slides();
    foreach ($infoSlide as $column => $value) {
      $newSlide->$column = $value;
    }

    $newSlide->path = "";

    if ($newSlide->save()) {
      $path = public_path() . "/slides/";

      $nameSlideFile = "slide_{$newSlide->id}.{$mainImage->getClientOriginalExtension()}";
      $mainImage->move($path, "$nameSlideFile");
      //actualizar y guardar la imagen del registro
      $newSlide->path = "/slides/$nameSlideFile";
      $newSlide->update();
    }
    return ["message" => "success"];
  }

  //OBTENER UN SLIDE EXISTENTE
  public function get($id) {
    $slide = Slides::find($id);
    return $slide;
  }
  
  //OBTENER UN SLIDE EXISTENTE
  public function getByPosition($position, $responsive) {
    $slides = Slides::where("show","1")->where("position",$position)->where("responsive",$responsive)->orderBy('order', 'asc')->get();
    return $slides;
  }

  //ACTUALZIA UN SLIDE
  public function update($id, Request $request) {
    $data = json_decode(Input::post("data"), true);

    $slide = Slides::find($id);

    foreach ($data as $column => $value) {
      $slide->$column = $value;
    }
    if ($request->hasfile('image')) {
      $img = $request->file('image');
      $path = public_path() . "/slides/";

      $nameSlideFile = "slide_{$slide->id}.{$img->getClientOriginalExtension()}";
      unlink("/slides/$nameSlideFile");
      $img->move($path, "$nameSlideFile");
      //actualizar y guardar la imagen del registro
      $slide->path = "/slides/$nameSlideFile";
    }
    return( $slide->update()) ? ["message" => "success"] : ["message" => "error"];
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
