<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function index(Request $request)
    {
        // get user with pagination
        $categories = DB::table('categories')
            ->where('name', 'like', '%' . $request->search . '%')
            ->paginate(5);

        return view('pages.category.index', compact('categories'));
    }
    //create

}
