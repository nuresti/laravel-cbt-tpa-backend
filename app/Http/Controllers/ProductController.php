<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index(Request $request)
    {
        // get user with pagination
        $products = Product::with('category')->paginate(5);

        return view('pages.product.index', compact('products'));
    }
    function create()
    {
        $categories = DB::table('categories')->get();
        return view('pages.product.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'is_available' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);
        //store the request ...
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->is_available = $request->is_available;
        $product->is_favorite = $request->is_favorite;
        $product->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = DB::table('categories')->get();
        return view('pages.product.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'is_available' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);
        //store the request ...
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->is_available = $request->is_available;
        $product->is_favorite = $request->is_favorite;
        $product->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
