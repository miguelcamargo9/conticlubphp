<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

// Models
use App\Models\Profile;

class ProfilesController extends BaseController
{
    use AuthorizesRequests,
      ValidatesRequests;

    public function allProfiles()
    {
        return Profile::all();
    }

    //Get all profiles
    public function all()
    {
        return Profile::all();
    }

    //Create a new profile
    public function create(Request $r): array
    {
        $profileR = json_decode($r->getContent(), true);
        $profile = new Profile();
        foreach ($profileR as $column => $value) {
            $profile->$column = $value;
        }
        return($profile->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    //Get an existing profile
    public function get($id)
    {
        return Profile::find($id);
    }

    //Update a profile
    public function update($id, Request $r): array
    {
        $profileR = json_decode($r->getContent(), true);
        $profile = Profile::find($id);
        foreach ($profileR as $column => $value) {
            $profile->$column = $value;
        }
        return($profile->update()) ? ["message" => "success"] : ["message" => "error"];
    }

    //DELETE a profile
    public function delete($id): array
    {
        $profile = Profile::find($id);
        try {
            $profile->delete();
            return["message" => "success"];
        } catch (QueryException $e) {
            $error = $e->errorInfo;
            return ($error[0] == "23000") ?
                [
                    "message" => "error",
                    "detail" =>
                        "Este perfil se esta usando en otros registros.
                        Por favor verifique que este perfil se puede eliminar"
                ] : ["message" => "error", "detail" => $error[2]];
        } catch (Exception $e) {
            return ["message" => "error", "detail" => $e->getMessage()];
        }
    }

    public function getSellers()
    {
        return Profile::notAdmin()->get();
    }
}
