<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Unit\ProductRepoTest;

class ProductService
{


    private ProductRepository $productRepository;



    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }



    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function createProduct(array $data){

        return $this->productRepository->createProduct($data);

    }
}
