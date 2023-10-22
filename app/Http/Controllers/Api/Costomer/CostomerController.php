<?php

namespace App\Http\Controllers\Api\Costomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Costomer\CreateCostomerRequest;
use App\Http\Requests\Api\Costomer\UpdateCostomerRequest;
use App\Models\Costomer\Costomer;
use App\Services\Costomer\CostomerService;
use App\Services\Costomer\CreateCostomerService;
use App\Services\Costomer\GetCostomerService;
use App\Services\Costomer\ListCostomerService;
use App\Services\Costomer\UpdateCostomerService;
use Exception;
use Illuminate\Http\Request;

class CostomerController extends Controller
{
    public function getCostomer(GetCostomerService $service, $id)
    {
        $costomer = $service->handle($id);

        return response()->json([
            'success' => true,
            'data' => $costomer->toArray(),
        ], 200);
    }

    public function listCostomer(Request $request, ListCostomerService $service)
    {

        $queryParams = $request->all();
        $costomers = $service->handle($queryParams);

        return response()->json($costomers, 200);
    }

    public function createCostomer(CreateCostomerRequest $request, CreateCostomerService $service)
    {
        $costomer = $service->handle(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'data' => $costomer->toArray(),
        ], 201, ['Location' => '/api/costomer/' . $costomer->id]);
    }

    public function updateCostomer(UpdateCostomerRequest $request, UpdateCostomerService $service, $id)
    {
        $params = $request->validated();

        $costomer = $service->handle($params, $id);
        
        return response()->json(['success' => true, 'data' => $costomer->toArray()], 200);
    }
}
