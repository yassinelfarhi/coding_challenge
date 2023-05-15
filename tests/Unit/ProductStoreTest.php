<?php

namespace Unit;

use App\Http\Requests\ProductRequest;
use Tests\TestCase;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertTrue;

class ProductStoreTest extends TestCase
{

    use RefreshDatabase;

    public function testStore()
    {

    $newProduct = [
        'name' => 'New Product',
        'price' => 10.99,
        'description' => "SDQSDQSD",
        'category' => ["name" => "standard"]
    ];


     $response = $this->post('/products/persiste', $newProduct);
     $response = $this->post('/products/persiste', $newProduct);

    $response->assertStatus(201);

     $this->assertDatabaseHas('products', ['name' => 'New Product','price' => 10.99,'description' => "SDQSDQSD"]);

    }





}
