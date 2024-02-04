<?php

namespace App\Http\Controllers;

use App\Models\SupplyCategory;
use Illuminate\Http\Request;

class SupplyCategoryApiController extends Controller
{

    // * get supCategory
    public function get()
    {
        $supplyCategory = SupplyCategory::with('supplies')->get();
        return response()->json([
            'data' => $supplyCategory
        ]);
    }
    //* create supCategory
    public function create()
    {
        $input = request()->all();
        $supplyCategory = new SupplyCategory();
        $supplyCategory->name = $input['name'];
        $result = $supplyCategory->save();
        return response()->json([
            'data' => $supplyCategory
        ]);
    }

    // * update supCategory
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $supplyCategory = SupplyCategory::find($id);
        $supplyCategory->name = $input['name'];
        $result = $supplyCategory->save();
        return response()->json([
            "data" => $supplyCategory
        ]);
    }

    // * delete supCategory
    public function delete($id)
    {
        $supplyCategory = SupplyCategory::find($id);
        $result = $supplyCategory->delete();

        return response()->json([
            'data' => [
                'result' => $result
            ]
        ]);
    }
}
