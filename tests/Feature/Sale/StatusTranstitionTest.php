<?php

namespace Tests\Feature\Sale;

use App\Enums\Sale\SaleEnum;
use App\Models\User;
use App\Models\Sale\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusTranstitionTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_change_to_paid_from_waiting_payment(): void
    {
        $status = SaleEnum::Paid->value;
        
        $sale = Sale::factory()->create();
        
        $this->actingAs($this->user);

        $response = $this->patch(route('api.sale.transtition', [
            'id' => $sale->id,
            'new_status' => $status,
        ]));

        $response->assertOk();
    }
    
    public function test_can_change_to_completed_from_paid(): void
    {
        $status = SaleEnum::Completed->value;
        
        $sale = Sale::factory()->create();
        $sale->status = SaleEnum::Paid->value;
        $sale->save();

        $this->actingAs($this->user);

        $response = $this->patch(route('api.sale.transtition', [
            'id' => $sale->id,
            'new_status' => $status,
        ]));

        $response->assertOk();
    }

    public function test_can_change_to_canceled_from_waiting_payment(): void
    {
        $status = SaleEnum::Canceled->value;
        
        $sale = Sale::factory()->create();

        $this->actingAs($this->user);

        $response = $this->patch(route('api.sale.transtition', [
            'id' => $sale->id,
            'new_status' => $status,
        ]));

        $response->assertOk();
    }

    public function test_can_change_to_canceled_from_paid(): void
    {
        $status = SaleEnum::Canceled->value;
        
        $sale = Sale::factory()->create();
        $sale->status = SaleEnum::Paid->value;

        $this->actingAs($this->user);

        $response = $this->patch(route('api.sale.transtition', [
            'id' => $sale->id,
            'new_status' => $status,
        ]));

        $response->assertOk();
    }

    public function test_cannot_cancel_completed_sale(): void
    {
        $status = SaleEnum::Canceled->value;
    
        $sale = Sale::factory()->create();
        $sale->status = SaleEnum::Completed->value;
        $sale->save();

        $this->actingAs($this->user);

        $response = $this->patch(route('api.sale.transtition', [
            'id' => $sale->id,
            'new_status' => $status,
        ]));

        $response->assertBadRequest();
    }
}
