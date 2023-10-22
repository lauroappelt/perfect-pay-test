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

    public function pay()
    {
        $this->sale->status = SaleEnum::Paid;
        $this->sale->save();

        //send email payment

        //dispatch events

        //any other logics for payment
    }

    public function cancel()
    {
        $this->sale->status = SaleEnum::Canceled;
        $this->sale->save();

        //send email cancel

        //dispatch events

        //any other logics for payment
    }
}
