<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(){
        try {
            $ingredients = Ingredient::all();
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
            $product = Product::find($request->input('manufacturer_id'));
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
            return response()->json($ingredient, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(int $id){
        try {
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
