<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function __construct(private readonly ProductService  $productService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index($providerId): ProductCollection
    {
        $products = $this->productService->index($providerId);
        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, $providerId): ProductResource
    {
        $product = $this->productService->store($providerId, $request->validated());
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): ProductResource
    {
        $product = $this->productService->show($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id): ProductResource
    {
        $product = $this->productService->update($id, $request->validated());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->productService->destroy($id);
        return response()->json(null, 204);
    }
}
