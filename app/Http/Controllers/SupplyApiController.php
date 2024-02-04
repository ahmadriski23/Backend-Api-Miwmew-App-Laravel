<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyApiController extends Controller
{

    // * get supply
    public function get(Request $request)
    {
        $supply = Supply::all();
        return response()->json([
            "data" => $supply
        ]);
    }

    public function getByCategoryId(Request $request, $supplyCategoryId)
    {
        $supply = Supply::where('supply_category_id', $supplyCategoryId)->get();
        return response()->json([
            "data" => $supply
        ]);
    }
    // * create supply
    public function create(Request $request)
    {
        $input = request()->all();
        $supply = new Supply();
        $supply->supply_category_id = $input['supply_category_id'];
        $supply->name = $input['name'];
        $supply->image = $input['image'];
        $supply->description = $input['description'];
        $supply->price = $input['price'];
        $result = $supply->save();

        return response()->json([
            "data" => $supply
        ]);
    }
    public function update(Request $request, $id)
    {
        $input = request()->all();
        $supply = Supply::find($id);
        $supply->supply_category_id = $input['supply_category_id'];
        $supply->name = $input['name'];
        $supply->image = $input['image'];
        $supply->description = $input['description'];
        $supply->price = $input['price'];
        $result = $supply->save();
        return response()->json([
            "data" => $supply
        ]);
    }

    public function delete(Request $request, $id)
    {
        $supply = Supply::find($id);
        $result = $supply->delete();

        return response()->json([
            "data" => [
                "result" => $result
            ]
        ]);
    }
}
