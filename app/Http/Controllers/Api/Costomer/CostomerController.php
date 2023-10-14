<?php

namespace App\Http\Controllers\Api\Costomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Costomer\CreateCostomerRequest;
use App\Http\Requests\Api\Costomer\UpdateCostomerRequest;
use App\Models\Costomer\Costomer;
use App\Services\Costomer\CostomerService;
use App\Services\Costomer\CreateCostomerService;
use App\Services\Costomer\UpdateCostomerService;
use Exception;

class CostomerController extends Controller
{
    public function __construct(
        private CostomerService $service,
    ) {}

    public function createCostomer(CreateCostomerRequest $request)
    {
        try {
            $costomer = $this->service->handle(
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'data' => $costomer->toArray(),
            ], 201, ['Location' => '/api/costomer/' . $costomer->id]);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function updateCostomer(UpdateCostomerRequest $request, $id)
    {
        try {
            $params = $request->validated();

            $costomer = $this->service->handle($params, $id);
            return response()->json(['success' => true, 'data' => $costomer->toArray()], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }
}
