<?php

namespace Tests\Feature\Sale;

use App\Enums\Sale\SaleEnum;
use App\Models\Product\Product;
use App\Models\User;
use App\Models\Costomer\Costomer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSaleTest extends TestCase
{   
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_an_create_new_sale(): void
    {
        $product = Product::factory()->create();

        $costomer = Costomer::factory()->create();

        $this->actingAs($this->user);

        $response = $this->post(route('api.sale.create'), [
            'costomer_id' => $costomer->id,
            'product_id' => $product->id,
            'ammount' => 2,
            'discount' => 0,
        ]);

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
}
