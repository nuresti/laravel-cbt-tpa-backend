<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Get the categories from the database
        // $categories = Category::paginate(10);
        //get all categories
        $categories = Category::all();
        // Return the categories as a JSON response
        return response()->json([
            'success' => true,
            'data' => $categories,
        ], 200);
    }
}
