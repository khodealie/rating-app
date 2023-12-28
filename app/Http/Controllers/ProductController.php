<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
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
    public function show($productId): ProductResource
    {
        $product = $this->productService->show($productId);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $productId): ProductResource
    {
        $product = $this->productService->update($productId, $request->validated());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId): JsonResponse
    {
        $this->productService->destroy($productId);
        return response()->json(null, 204);
    }
}
