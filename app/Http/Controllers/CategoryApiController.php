<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{

    // * get category
    public function get()
    {
        $category = Category::with('products')->get();
        return response()->json([
            "data" => $category
        ]);
    }
    // * create category
    public function create()
    {
        $input = request()->all();
        $category = new Category();
        $category->name = $input['name'];
        $category->image = $input['image'];
        $result = $category->save();
        return response()->json([
            "data" => $category
        ]);
    }

    // * update 
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $category = Category::find($id);
        $category->name = $input['name'];
        $category->image = $input['image'];
        $result = $category->save();
        return response()->json([
            "data" => $category
        ]);
    }

    // * delete
    public function delete($id)
    {
        $category = Category::find($id);
        $result = $category->delete();

        return response()->json([
            "data" => [
                "result" => $result
            ],
        ]);
    }
}
