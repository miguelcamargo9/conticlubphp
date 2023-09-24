<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

// Models
use App\Models\Profiles;

class ProfilesController extends BaseController
{
    use AuthorizesRequests,
      ValidatesRequests;

    public function allProfiles()
    {
        return Profiles::all();
    }

    //Get all profiles
    public function all()
    {
        return Profiles::all();
    }

    //Create a new profile
    public function create(Request $r): array
    {
        $profileR = json_decode($r->getContent(), true);
        $profile = new Profiles();
        foreach ($profileR as $column => $value) {
            $profile->$column = $value;
        }
        return($profile->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    //Get an existing profile
    public function get($id)
    {
        return Profiles::find($id);
    }

    //Update a profile
    public function update($id, Request $r): array
    {
        $profileR = json_decode($r->getContent(), true);
        $profile = Profiles::find($id);
        foreach ($profileR as $column => $value) {
            $profile->$column = $value;
        }
        return($profile->update()) ? ["message" => "success"] : ["message" => "error"];
    }

    //DELETE a profile
    public function delete($id): array
    {
        $profile = Profiles::find($id);
        try {
            $profile->delete();
            return["message" => "success"];
        } catch (\Illuminate\Database\QueryException $e) {
            $error = $e->errorInfo;
            return ($error[0] == "23000") ?
                [
                    "message" => "error",
                    "detail" =>
                        "Este perfil se esta usando en otros registros.
                        Por favor verifique que este perfil se puede eliminar"
                ] : ["message" => "error", "detail" => $error[2]];
        }
    }

    public function getSellers()
    {
        return Profiles::notAdmin()->get();
    }
}
