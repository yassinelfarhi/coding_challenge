<?php

namespace App\Console\Commands;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Console\Command;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-product {name} {description} {price} {category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $data = [
                'name' => $this->argument('name'),
                'description' => $this->argument('description'),
                'price' => $this->argument('price'),
                'category' => ['name' => $this->argument('category')]
        ];
        
        $productRequest = new ProductRequest();
        $productRequest->merge($data);
        $validatedData = $productRequest->validate($productRequest->rules());

        $productRepository = new ProductRepository();
        $productRepository->createProduct($validatedData);



    }
}
