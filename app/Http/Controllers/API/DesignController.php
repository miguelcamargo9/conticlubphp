<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;

// Models
use App\Models\Design;

class DesignController
{
    public function all()
    {
        return Design::with("brand")->get();
    }

    public function create(Request $r): array
    {
        $data = json_decode($r->getContent(), true);
        $design = new Design();
        foreach ($data as $column => $value) {
            $design->$column = $value;
        }
        $exist = Design::where("name", "=", $design->name)->first();
        if ($exist) {
            return ["message" => "Este diseño ya existe."];
        }
        return($design->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function get($id)
    {
        return Design::with("brand")->find($id);
    }


    /**
     * @param $id
     * @param Request $r
     * @return string[]
     */
    public function update($id, Request $r): array
    {
        $data = json_decode($r->getContent(), true);
        $design = Design::find($id);
        foreach ($data as $column => $value) {
            $design->$column = $value;
        }
        $exist = Design::where("name", "=", $design->name)->where("id", "!=", $id)->first();
        if ($exist) {
            return ["message" => "Este diseño ya existe."];
        }
        return($design->update()) ? ["message" => "success"] : ["message" => "error"];
    }


    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        return(Design::find($id)->delete()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function getByBrand($idBrand)
    {
        return Design::where("brand_id", "=", $idBrand)->orderBy('name', 'ASC')->get();
    }
}
