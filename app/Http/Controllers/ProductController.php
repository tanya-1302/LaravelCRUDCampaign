<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Manufacturer;

class ProductController extends Controller
{
    public function index(Request $request){
        try {
            $products = $request->manufacturer->products;
            $products->each(function ($product) {
                if ($product->image) {
                    // $path = base64_decode($product->image);
                    $product->image = Storage::url($product->image);
                }
            });
            return response()->json($products, 200);
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
    public function store(ProductRequest $request){
        try {
            $data = $request->validated();

            $product = $request->manufacturer->products()->create($data);

            return response()->json($product, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductRequest $request, int $id){
        // dd($request->getContent());
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $data['image'] = $path;
            }
            $manufacturer = Manufacturer::find($data['manufacturer_id']);
            $product->update($data);
            $product->manufacturer()->associate($manufacturer);
            $product->save();
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id){
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
