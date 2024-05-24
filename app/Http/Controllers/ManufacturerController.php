<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index(){
        try {
            $manufacturers = Manufacturer::all();
            return response()->json($manufacturers, 200);
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
    public function store(ManufacturerRequest $request){
        try{
            $manufacturer = Manufacturer::create($request->validated());
            return response()->json($manufacturer, 201);        
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ManufacturerRequest $request, int $id){
        try {
            $manufacturer = Manufacturer::findOrFail($id);
            $manufacturer->update($request->validated());
            return response()->json($manufacturer, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id){
        try {
            $manufacturer = Manufacturer::findOrFail($id);
            $manufacturer->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
