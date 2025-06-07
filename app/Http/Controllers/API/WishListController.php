<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

// Models
use App\Models\WishList;

class WishListController extends BaseController
{
    public function create(Request $r)
    {
        $infoUser = $r->user();

        $data = json_decode($r->getContent(), true);
        $wishList = new WishList();
        $wishList->users_id = $infoUser->id;
        foreach ($data as $column => $value) {
            $wishList->$column = $value;
        }
        return($wishList->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function get($id)
    {
        return WishList::where("users_id", $id)->with("product")->get();
    }

    public function all()
    {
        return WishList::with(["product","user:id,name"])->get();
    }
}
