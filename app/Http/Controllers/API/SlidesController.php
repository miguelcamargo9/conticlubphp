<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Slides;

class SlidesController extends BaseController
{
    public function all()
    {
        return Slides::all();
    }

    public function create(Request $r)
    {
        $infoSlide = json_decode(Input::post("data"), true);
        $mainImage = $r->file('image');

        $newSlide = new Slides();
        foreach ($infoSlide as $column => $value) {
            $newSlide->$column = $value;
        }

        $newSlide->path = "";

        if ($newSlide->save()) {
            $path = "/files/slides/slide_$newSlide->id.{$mainImage->getClientOriginalExtension()}";
            Storage::disk('s3')->put($path, file_get_contents($mainImage));

            //actualizar y guardar la imagen del registro
            $newSlide->path = $path;
            $newSlide->update();
        }
        return ["message" => "success"];
    }

    public function get($id)
    {
        return Slides::find($id);
    }

    public function getByPosition($position, $responsive)
    {
        return Slides::where("show", "1")
            ->where("position", $position)
            ->where("responsive", $responsive)
            ->orderBy('order')->get();
    }

    public function update($id, Request $request)
    {
        $data = json_decode(Input::post("data"), true);

        $slide = Slides::find($id);

        foreach ($data as $column => $value) {
            $slide->$column = $value;
        }
        if ($request->hasfile('image')) {
            $img = $request->file('image');
            $path = public_path() . "/slides/";

            $nameSlideFile = "slide_$slide->id.{$img->getClientOriginalExtension()}";
            unlink("/slides/$nameSlideFile");
            $img->move($path, "$nameSlideFile");
            //actualizar y guardar la imagen del registro
            $slide->path = "/slides/$nameSlideFile";
        }
        return($slide->update()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function delete($id)
    {
        $slide = Slides::find($id);
        try {
            $slide->delete();
            return["message" => "success"];
        } catch (QueryException $e) {
            $error = $e->errorInfo;
            return ($error[0] == "23000") ?
                [
                    "message" => "error",
                    "detail" => "Este slide se esta usando en otros registros.
                                    Por favor verifique que este slide se pueda eliminar"
                ]
                : ["message" => "error", "detail" => $error[2]];
        } catch (Exception $e) {
            return ["message" => "error", "detail" => $e->getMessage()];
        }
    }
}
