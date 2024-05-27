<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ImageFileDownloadController extends Controller
{
    public function download(Request $request){
        $product = Product::find($request->query('product_id'));
        if($product->image){
        $filePath = $product->image;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath)) {
            // Return a response that forces a download
            return response()->download(storage_path('app/public/' . $filePath), "ngnSrvVxHnH0G8PH6WmX8ceu2c5rxlboGa47kSga.jpg");
        }
    }
}
}