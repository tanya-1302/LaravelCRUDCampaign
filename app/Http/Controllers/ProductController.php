<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Manufacturer;

class ProductController extends Controller
{
    public function index(Request $request){
        try {
            // $products = $request->products;
            $products = $request->manufacturer->products;
            // $products->each(function ($product) {
            //     if ($product->image) {
            //         dd($product->image);
            //         // $path = base64_decode($product->image);
            //         $product->image = Storage::disk('local')->get($product->image);
            //     }
            // });
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
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $data['image'] = $path;
                // $image_data = file_get_contents($request->file('image'));
                // $data['image'] = base64_encode($image_data);
            }

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
            if($product->manufacturer_id != $request->manufacturer->id){
                return response()->json('cannot update values for this manufacturer');
            }
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $data['image'] = $path;
            }
            $request->manufacturer->products()->update($data);
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
