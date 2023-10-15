<?php

namespace App\Http\Controllers\Api\Costomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Costomer\CreateCostomerRequest;
use App\Http\Requests\Api\Costomer\UpdateCostomerRequest;
use App\Models\Costomer\Costomer;
use App\Services\Costomer\CostomerService;
use Exception;
use Illuminate\Http\Request;

class CostomerController extends Controller
{
    public function __construct(
        private CostomerService $service,
    ) {}

    public function getCostomer($id)
    {
        try {
            $costomer = $this->service->handle($id);

            return response()->json([
                'success' => true,
                'data' => $costomer->toArray(),
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    public function listCostomer(Request $request)
    {
        try {

            $queryParams = $request->all();
            $costomers = $this->service->handle($queryParams);

            return response()->json($costomers, 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

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
