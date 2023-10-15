<?php

namespace Tests\Feature\Product;

use App\Models\Product\Product;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    private $user;
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_update_product(): void
    {
        $product = Product::factory()->create();
        $product->name .= ' updated';

        $response = $this->actingAs($this->user)->put(route('api.product.update', ['id' => $product->id]), $product->toArray(), ['Accept' => 'application/json']);

        $response->assertOk();

        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'description',
                'price'
            ]
        ]);

        $json = $response->json();

        $this->assertEquals($product->name, $json['data']['name']);
    }

    public function test_cannot_update_non_existing_product():void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->put(route('api.product.update', ['id' => Uuid::uuid4()]), $product->toArray(), ['Accept' => 'application/json']);

        $response->assertNotFound();
    }
}
