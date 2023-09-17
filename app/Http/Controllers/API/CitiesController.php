<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

// Models
use App\Models\Cities;

class CitiesController extends BaseController
{
    use AuthorizesRequests,
      ValidatesRequests;

    public function all()
    {
        return Cities::all();
    }

    public function create(Request $req): array
    {
        $cityR = json_decode($req->getContent(), true);
        $city = new Cities();
        foreach ($cityR as $column => $value) {
            $city->$column = $value;
        }
        $exist = Cities::where("name", "=", $city->name)->first();
        if ($exist) {
            return ["message" => "Esta ciudad ya existe"];
        }
        return($city->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function get($id)
    {
        return Cities::find($id);
    }

    public function update($id, Request $req): array
    {
        $cityR=json_decode($req->getContent(), true);
        $city = Cities::find($id);
        foreach ($cityR as $column => $value) {
            $city->$column = $value;
        }
        $exist = Cities::where("name", "=", $city->name)->where("id", "!=", $city->id)->first();
        if ($exist) {
            return ["message" => "Esta ciudad ya existe"];
        }
        return($city->update())?["message"=>"success"]:["message"=>"error"];
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $city = Cities::find($id);
        return($city->delete()) ? ["message" => "success"] : ["message" => "error"];
    }
}
