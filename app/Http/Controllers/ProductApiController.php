<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    public function get(Request $request)
    {
        $product = Product::all();
        return response()->json([
            "data" => $product
        ]);

    }

    public function getByCategoryId(Request $request, $categoryId)
    {
        $product = Product::where('category_id', $categoryId)->get();
        return response()->json([
            "data" => $product,
        ]);
    }
    public function create(Request $request)
    {
        $input = request()->all();
        $product = new Product();
        $product->category_id = $input['category_id'];
        $product->name = $input['name'];
        $product->image = $input['image'];
        $product->gender = $input['gender'];
        $product->description = $input['description'];
        $product->price = $input['price'];
        $product->weight = $input['weight'];
        $product->born = $input['born'];
        $product->date_of_birth = $input['date_of_birth'];
        $result = $product->save();

        return response()->json([
            "data" => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = request()->all();
        $product = Product::find($id);
        $product->category_id = $input['category_id'];
        $product->name = $input['name'];
        $product->image = $input['image'];
        $product->gender = $input['gender'];
        $product->description = $input['description'];
        $product->price = $input['price'];
        $product->weight = $input['weight'];
        $product->born = $input['born'];
        $product->date_of_birth = $input['date_of_birth'];
        $result = $product->save();
        return response()->json([
            "data" => $product,
        ]);
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $result = $product->delete();

        return response()->json([
            "data" => [
                "result" => $result
            ],
        ]);
    }
}
