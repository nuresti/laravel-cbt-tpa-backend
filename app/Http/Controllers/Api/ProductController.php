<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Get the products from the database
        // $products = Product::paginate(10);
        //get all products
        $products = Product::all();
        // Return the products as a JSON response
        return response()->json([
            'success' => true,
            'data' => $products,
        ], 200);
    }
}
