<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts(): JsonResponse
    {
        return response()->json($this->productService->getAllProducts());
    }


    public function index() 
    {
        $products = $this->productService->getAllProducts();
        return view('products.listing',compact('products')); 
    }


    public function store(ProductRequest $request)
    {
 
        $validated = $request->validated();

        $product = $this->productService->createProduct($validated);

        return $product;
    }
}
