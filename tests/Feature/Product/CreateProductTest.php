<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_create_produt(): void
    {
        $payload = [
            'name' => 'product',
            'description' => 'description of product',
            'price' => 299
        ];

        $response = $this->actingAs($this->user)->post(route('api.product.create'), $payload, ['Accept' => 'application/json']);

        $response->assertCreated();

        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'description',
                'price'
            ]
        ]);
    }

    public function test_cannot_create_product_without_required_fields(): void
    {
        $payload = [
            'description' => 'description of product',
            'price' => 299
        ];

        $response = $this->actingAs($this->user)->post(route('api.product.create'), $payload, ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }

    public function test_cannot_create_product_with_decimal_price(): void
    {
        $payload = [
            'name' => 'product',
            'description' => 'description of product',
            'price' => 2.99
        ];

        $response = $this->actingAs($this->user)->post(route('api.product.create'), $payload, ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }
}
