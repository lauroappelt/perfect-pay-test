<?php

namespace Tests\Unit\Enums\Sale;

use PHPUnit\Framework\TestCase;
use App\Enums\Sale\SaleEnum;
use App\Models\Sale\Sale;
use App\States\Sale\Canceled;
use App\States\Sale\Completed;
use App\States\Sale\Paid;
use App\States\Sale\WaitingPayment;
use Tests\Unit\Enums\Sale\SaleEnum as SaleSaleEnum;

class SaleEnumTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_create_sale_state_waiting_payment(): void
    {   
        $saleEnum = SaleEnum::WaitingPayment;
        $sale = new Sale([
            'status' => $saleEnum->value,
        ]);

        $saleState = $saleEnum->createSaleState($sale);

        $this->assertInstanceOf(WaitingPayment::class, $saleState);
    }

    public function test_create_sale_state_paid(): void
    {   
        $saleEnum = SaleEnum::Paid;
        $sale = new Sale([
            'status' => $saleEnum->value,
        ]);

        $saleState = $saleEnum->createSaleState($sale);

        $this->assertInstanceOf(Paid::class, $saleState);
    }

    public function test_create_sale_state_completed(): void
    {   
        $saleEnum = SaleEnum::Completed;
        $sale = new Sale([
            'status' => $saleEnum->value,
        ]);

        $saleState = $saleEnum->createSaleState($sale);

        $this->assertInstanceOf(Completed::class, $saleState);
    }

    public function test_create_sale_state_canceled(): void
    {   
        $saleEnum = SaleEnum::Canceled;
        $sale = new Sale([
            'status' => $saleEnum->value,
        ]);

        $saleState = $saleEnum->createSaleState($sale);

        $this->assertInstanceOf(Canceled::class, $saleState);
    }
}
