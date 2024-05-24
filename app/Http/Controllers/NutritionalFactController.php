<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionalFactRequest;
use App\Models\Nutritional_fact;
use App\Models\NutritionalFact;
use Illuminate\Http\Request;

class NutritionalFactController extends Controller
{
    public function index(){
        $nutritionalFact = NutritionalFact::all();
        return $nutritionalFact;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(NutritionalFactRequest $request){
        return NutritionalFact::create($request->all());
    }

    public function update(NutritionalFactRequest $request, int $id){
        $nutritionalFact = NutritionalFact::find($id);
        $nutritionalFact->update($request->all());
        return $nutritionalFact::find($id);
    }

    public function delete(int $id){
        $nutritionalFact = NutritionalFact::find($id);
        $nutritionalFact->delete();
    }
}
