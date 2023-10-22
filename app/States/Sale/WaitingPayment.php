<?php

namespace App\States\Sale;

use App\Enums\Sale\SaleEnum;
use App\States\Sale\SaleState;

class WaitingPayment extends SaleState
{
    public function __toString()
    {
        return SaleEnum::WaitingPayment->value;
    }
}
