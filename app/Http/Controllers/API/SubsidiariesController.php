<?php
namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


// Models
use App\Models\Subsidiary ;

class SubsidiariesController extends BaseController
{
    public function all()
    {
        return Subsidiary::with("city")->with("profile")->get();
    }

    public function create(Request $r)
    {
        $data = json_decode($r->getContent(), true);
        $subsidiary = new Subsidiary();
        foreach ($data as $column => $value) {
            $subsidiary->$column = $value;
        }
        return($subsidiary->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function get($id)
    {
        return Subsidiary::with("city")->with("profile")->find($id);
    }

    public function update($id, Request $r)
    {
        $data = json_decode($r->getContent(), true);
        $subsidiary = Subsidiary::find($id);
        foreach ($data as $column => $value) {
            $subsidiary->$column = $value;
        }
        return($subsidiary->update()) ? ["message" => "success"] : ["message" => "error"];
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        $subsidiary = Subsidiary::find($id);
        return($subsidiary->delete()) ? ["message" => "success"] : ["message" => "error"];
    }
}
