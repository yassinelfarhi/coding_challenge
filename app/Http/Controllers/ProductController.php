<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    

    public function getProducts(){

        $products = Product::all();
        return response()->json($products);
    }


    public function getCategories(){


        $categories = Category::all();
        return response()->json($categories);
    }


    public function index() 
    {

        $products = Product::all();
        return view('products.listing',compact('products')); 

    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->category_name = $validated['category'];
        $product->save();
        
        $category = new Category();
        $category->name = $validated['category'];
        $category->product_id = $product->id;
        $category->save();
    }
}
