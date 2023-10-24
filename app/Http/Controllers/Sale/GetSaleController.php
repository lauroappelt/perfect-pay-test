<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Services\Sale\GetSaleService;
use Illuminate\Http\Request;

class GetSaleController extends Controller
{
    public function __construct(
        private GetSaleService $getSaleService
    ) {}

    public function __invoke($id)
    {
        $sale = $this->getSaleService->handle($id);

        return response()->json([
            'success' => true,
            'data' => $sale->toArray()
        ], 200);
    }
}