<?php

namespace App\States\Sale;

use App\States\Sale\SaleState;
use App\Enums\Sale\SaleEnum;

class Paid extends SaleState
{
    public function finalize()
    {
        $this->sale->status = SAleEnum::Completed;
        $this->sale->save();

        //send email finalization

        //dispatch events

        //any other logics for finalization
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
