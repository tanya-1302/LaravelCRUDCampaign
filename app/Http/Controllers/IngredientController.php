<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request){
        try {
            $product = Product::findOrFail($request->query('product_id'));
            $ingredients = $product->ingredient;
            // $ingredients = Ingredient::where('product_id', '=', $product_id)->firstOrFail();
            // $ingredients = Ingredient::all();
            return response()->json($ingredients, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientRequest $request){
        try{
            $ingredient = Ingredient::create($request->validated());
            $product = Product::find($request->input('product_id'));
            $ingredient->product()->associate($product);
            return response()->json($ingredient, 201);        
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(IngredientRequest $request, int $id){
        try {
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->update($request->validated());
            $product = Product::find($request->input('product_id'));
            $ingredient->product()->associate($product);
            return response()->json($ingredient, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id){
        try {
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
