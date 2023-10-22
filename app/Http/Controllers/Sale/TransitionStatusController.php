<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Services\Sale\TransitionStatusService;
use Illuminate\Http\Request;

class TransitionStatusController extends Controller
{
    public function __construct(
        private TransitionStatusService $service
    ) {}

    public function __invoke(string $id, string $newStatus) 
    {
        $this->service->handle($id, $newStatus);

        return response()->json(['success' => true]);
    }
}
