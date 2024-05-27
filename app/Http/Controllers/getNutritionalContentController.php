<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;

class getNutritionalContentController extends Controller
{
    public function countForProduct(Request $request){
        $product = Product::findOrfail($request->query('product_id'));
        $ingredients = $product->ingredient;
        $nutritionalContent = array();
        $ingredients->each(function($ingredient) use (&$nutritionalContent){
            $nutritionalFacts = $ingredient->nutritionalFact;
            $nutritionalFacts->each(function($nutritionalFact) use (&$nutritionalContent){
                if(empty($nutritionalContent[$nutritionalFact->name])){
                    $nutritionalContent[$nutritionalFact->name] = 0;
                }
                $nutritionalContent[$nutritionalFact->name] += $nutritionalFact->quantity;
            });
        });
        return response()->json($nutritionalContent);
}
}