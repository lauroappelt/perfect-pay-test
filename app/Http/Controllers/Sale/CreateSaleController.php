<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleRequest;
use App\Http\Resources\Sale\CreateSaleResource;
use App\Services\Sale\CreateSaleService;
use Exception;
use Illuminate\Http\Request;

class CreateSaleController extends Controller
{
    public function __construct(
        private CreateSaleService $service
    ) {}

    public function __invoke(CreateSaleRequest $request) {

            $sale = $this->service->handle(
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'data' => $sale->toArray(),
            ], 201);
    }
}
