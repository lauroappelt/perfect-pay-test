<?php

namespace Tests\Feature\Sale;

use App\Models\Sale\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class GetSaleTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_get_sale(): void
    {
        $sale = Sale::factory()->create();

        $this->actingAs($this->user);

        $response = $this->get(route('api.sale.get', ['id' => $sale->id]));

        $response->assertOk();
    }

    public function test_cannot_get_non_existing_sale(): void
    {
        $this->actingAs($this->user);

        $response = $this->get(route('api.sale.get', ['id' => Uuid::uuid4()]));

        $response->assertNotFound();
    }
}
