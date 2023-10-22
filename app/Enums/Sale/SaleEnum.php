<?php

namespace App\Enums\Sale;

use App\Models\Sale\Sale;
use App\States\Sale\Canceled;
use App\States\Sale\Completed;
use App\States\Sale\Paid;
use App\States\Sale\WaitingPayment;
use App\States\Sale\SaleState;

enum SaleEnum: string
{
    case WaitingPayment = 'WaitingPayment';
    case Paid = 'Paid';
    case Completed = 'Completed';
    case Canceled = 'Canceled';

    public function createSaleState(Sale $sale): SaleState
    {
        return match($this) {
            SaleEnum::WaitingPayment => new WaitingPayment($sale),
            SaleEnum::Paid => new Paid($sale),
            SaleEnum::Completed => new Completed($sale),
            SaleEnum::Canceled => new Canceled($sale),
        };
    }
}
