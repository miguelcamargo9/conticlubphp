<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\Brand;

class BrandController
{
    public function all()
    {
        return Brand::all();
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $brand = new Brand();
        foreach ($data as $column => $value) {
            $brand->$column = $value;
        }
        return($brand->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function get($id)
    {
        return Brand::find($id);
    }

    public function update($id, Request $r): array
    {
        $data = json_decode($r->getContent(), true);
        $brand = Brand::find($id);

        foreach ($data as $column => $value) {
            $brand->$column = $value;
        }

        $exist = Brand::where('name', '=', $brand->name)
            ->where('id', '!=', $id)
            ->first();

        if ($exist) {
            return ["message" => "Esta marca ya existe."];
        }

        return ($brand->update()) ? ["message" => "success"] : ["message" => "error"];
    }

    /**
     * @throws Exception
     */
    public function delete($id): array
    {
        $brand = Brand::find($id);
        return($brand->delete()) ? ["message" => "success"] : ["message" => "error"];
    }
}
