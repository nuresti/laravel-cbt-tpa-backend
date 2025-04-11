<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    function create()
    {
        return view('pages.category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        //store the request ...
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id . '.' . $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' . $category->id . '.' . $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        //store the request ...
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id . '.' . $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' . $category->id . '.' . $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
