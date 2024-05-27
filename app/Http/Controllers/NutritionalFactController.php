<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionalFactRequest;
use App\Models\Ingredient;
use App\Models\NutritionalFact;
use Illuminate\Http\Request;

class NutritionalFactController extends Controller
{
    public function index(Request $request){
        try {
            $ingredient = Ingredient::findOrFail($request->query('ingredient_id'));
            $nutritionalFacts = $ingredient->NutritionalFact;

            return response()->json($nutritionalFacts, 200);
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
    public function store(NutritionalFactRequest $request){
        try{
            $nutritionalFact = NutritionalFact::create($request->validated());
            $ingredient = Ingredient::find($request->input('ingredient_id'));
            $nutritionalFact->ingredient()->attach($ingredient);
            return response()->json($nutritionalFact, 201);        
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(NutritionalFactRequest $request, int $id){
        try {
            $nutritionalFact = NutritionalFact::findOrFail($id);
            $nutritionalFact->update($request->validated());
            $ingredient = Ingredient::find($request->input('ingredient_id'));
            $nutritionalFact->ingredient()->attach($ingredient);
            return response()->json($nutritionalFact, 200);
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