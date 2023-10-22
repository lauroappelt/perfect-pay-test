<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\GetProductService;
use App\Services\Product\ListProductService;
use App\Services\Product\ProductService;
use App\Services\Product\UpdateProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(GetProductService $service, $id)
    {
        $product = $service->handle($id);

        return response()->json([
            'success' => true,
            'data' => $product->toArray(),
        ], 200);
    }

    public function createProduct(CreateProductRequest $request, CreateProductService $service)
    {

        $product = $service->handle(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'data' => $product->toArray(),
        ], 201);
    }

    public function updateProduct(UpdateProductRequest $request, UpdateProductService $service, $id)
    {

        $product = $service->handle(
            $request->validated(),
            $id
        );

        return response()->json([
            'success' => true,
            'data' => $product->toArray(),
        ], 200);
    }

    public function listProduct(Request $request, ListProductService $service)
    {

        $queryParams = $request->all();
        $products = $service->handle($queryParams);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
