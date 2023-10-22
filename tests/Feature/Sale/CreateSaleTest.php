<?php

namespace Tests\Feature\Sale;

use App\Enums\Sale\SaleEnum;
use App\Models\Product\Product;
use App\Models\User;
use App\Models\Costomer\Costomer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateSaleTest extends TestCase
{   
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_create_new_sale(): void
    {
        $product = Product::factory()->create();

        $costomer = Costomer::factory()->create();

        $this->actingAs($this->user);

        $response = $this->post(route('api.sale.create'), [
            'costomer_id' => $costomer->id,
            'product_id' => $product->id,
            'ammount' => 2,
            'discount' => 0,
        ],['Accept' => 'application/json']);

        $response->decodeResponseJson();

        $response->assertCreated();

        $response->assertJsonStructure([
            'success',
            'data' => [
                'product_id',
                'costomer_id',
                'ammount',
                'discount',
                'id',
                'status',
                'date',
            ]
        ]);

        $sale = $response->json()['data'];
        
        $this->assertEquals(SaleEnum::WaitingPayment->value, $sale['status']);

        $this->assertEquals(now('America/Sao_Paulo')->format('Y-m-d'), $sale['date']);

        $this->assertDatabaseHas('sales', $sale);
    }

    public function test_cannot_create_sale_with_non_existing_product(): void
    {
        $costomer = Costomer::factory()->create();

        $this->actingAs($this->user);

        $response = $this->post(route('api.sale.create'), [
            'costomer_id' => $costomer->id,
            'product_id' => Uuid::uuid4(),
            'ammount' => 2,
            'discount' => 0,
        ], ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }

    public function test_cannot_create_sale_with_non_existing_costomer(): void
    {
        $product = Product::factory()->create();

        $this->actingAs($this->user);

        $response = $this->post(route('api.sale.create'), [
            'costomer_id' => Uuid::uuid4(),
            'product_id' => $product->id,
            'ammount' => 2,
            'discount' => 0,
        ], ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }

    public function test_cannot_create_sale_with_ammount_less_than_one(): void
    {
        $product = Product::factory()->create();

        $costomer = Costomer::factory()->create();

        $this->actingAs($this->user);

        $response = $this->post(route('api.sale.create'), [
            'costomer_id' => $costomer->id,
            'product_id' => $product->id,
            'ammount' => -1,
            'discount' => 0,
        ],['Accept' => 'application/json']);

        $response->decodeResponseJson();

        $response->assertUnprocessable();
    }
}
