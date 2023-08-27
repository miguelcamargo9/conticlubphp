<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

//Models
use App\Models\Tire;
use App\Models\TirePointsByProfile;

class TireController extends BaseController
{
    public function all()
    {
        return Tire::with("design")->get();
    }

    public function create(Request $r): array
    {
        $saveOK = true;
        $data = json_decode($r->getContent(), true);
        $tire = new Tire();
        foreach ($data as $column => $value) {
            if ($column != "tire_points") {
                $tire->$column = $value;
            }
        }
        $exist = Tire::where("tire_code", "=", $tire->tire_code)->first();
        if ($exist) {
            return ["message" => "Este código de llanta ya existe"];
        }
        if (!isset($data['tire_points'])) {
            return ["message" => "Llanta sin puntos"];
        }
        if ($tire->save()) {
            $tireId = $tire->id;

            foreach ($data['tire_points'] as $points) {
                $tireByProfile = new TirePointsByProfile();
                $tireByProfile->tire_id = $tireId;
                $saveOK = $this->saveTirePointsByProfile($points, $tireByProfile);
            }

            return !$saveOK ? ["message" => "error"] : ["message" => "success"];
        } else {
            return["message" => "error"];
        }
    }

    public function get($id)
    {
        return Tire::with("design")->with("tirePointsByProfile")->find($id) ?? [];
    }

    /**
     * @throws Exception
     */
    public function update($id, Request $r): array
    {
        $data = json_decode($r->getContent(), true);
        $tire = Tire::find($id);
        $saveOK = true;
        foreach ($data as $column => $value) {
            if ($column != "tire_points") {
                $tire->$column = $value;
            }
        }
        $exist = Tire::where("tire_code", "=", $tire->tire_code)->where("id", "!=", $tire->id)->first();
        if ($exist) {
            return ["message" => "Este código de llanta ya existe"];
        }
        if (!isset($data['tire_points'])) {
            return ["message" => "Llanta sin puntos"];
        }
        if ($tire->update()) {
            TirePointsByProfile::where("tire_id", "=", $tire->id)->delete();

            foreach ($data['tire_points'] as $points) {
                $tireByProfile = new TirePointsByProfile();
                $tireByProfile->tire_id = $tire->id;
                $saveOK = $this->saveTirePointsByProfile($points, $tireByProfile);
            }
            return !$saveOK ? ["message" => "error"] : ["message" => "success"];
        } else {
            return ["message" => "error"];
        }
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $tire = Tire::find($id);
        TirePointsByProfile::where("tire_id", "=", $tire->id)->delete();
        return($tire->delete()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function getByDesign($idDesign)
    {
        return Tire::with("design")->where("design_id", "=", $idDesign)->orderBy('name', 'ASC')->get();
    }

    /**
     * @param $points
     * @param TirePointsByProfile $tirePointsByProfile
     * @return bool
     */
    public function saveTirePointsByProfile($points, TirePointsByProfile $tirePointsByProfile): bool
    {
        $tirePointsByProfile->profiles_id = $points['profiles_id'];
        $tirePointsByProfile->points_general = $points['points_general'];
        $tirePointsByProfile->points_uhp = $points['points_uhp'];
        $tirePointsByProfile->total_points = $points['points_general'] + $points['points_uhp'];
        return $tirePointsByProfile->save();
    }
}
