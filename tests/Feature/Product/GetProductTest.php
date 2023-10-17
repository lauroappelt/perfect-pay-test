<?php

namespace Tests\Feature\Product;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class GetProductTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_get_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->get(route('api.product.get', ['id' => $product->id]));

        $response->assertOk();

        $response->assertJsonStructure([
            'success',
            'data' =>  [
                'id',
                'name',
                'description',
                'price'
            ]
        ]);
    }

    public function test_cannot_get_non_existing_product(): void
    {
        $response = $this->actingAs($this->user)->get(route('api.product.get', ['id' => Uuid::uuid4()]));

        $response->assertNotFound();
    }
}
