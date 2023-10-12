<?php

namespace App\Http\Controllers\Api\Costomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Costomer\CreateCostomerRequest;
use App\Models\Costomer\Costomer;
use App\Services\Costomer\CreateCostomerService;
use Exception;
use Illuminate\Http\Request;

class CreateCostomerController extends Controller
{
    public function __construct(
        private CreateCostomerService $createCostomerService
    ) {}

    public function __invoke(CreateCostomerRequest $request)
    {
        try {
            $costomer = $this->createCostomerService->handle(
                $request->validated()
            );

            return response()
                ->json([
                    'success' => true,
                    'data' => $costomer->toArray(),
                ], 201, ['Location' => '/api/costomer/' . $costomer->id]);

        } catch (Exception $exception) {
            return response()->json(['success' => false, 'error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
