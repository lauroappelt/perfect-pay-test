<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\GetProductService;
use App\Services\Product\ProductService;
use App\Services\Product\UpdateProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(GetProductService $service, $id)
    {
        try {
            $product = $service->handle($id);

            return response()->json([
                'success' => true,
                'data' => $product->toArray(),
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage()
            ], $exception->getCode());
        }
    }

    public function createProduct(CreateProductRequest $request, CreateProductService $service)
    {
        try {

            $product = $service->handle(
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'data' => $product->toArray(),
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    public function updateProduct(UpdateProductRequest $request, UpdateProductService $service, $id)
    {
        try {

            $product = $service->handle(
                $request->validated(),
                $id
            );

            return response()->json([
                'success' => true,
                'data' => $product->toArray(),
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }
}
