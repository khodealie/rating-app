<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(private readonly ProductService $productService)
    {
    }

    /**
     * Display a listing of the products.
     */
    public function index($providerId): ProductCollection
    {
        return new ProductCollection($this->productService->index($providerId));
    }

    /**
     * Display a listing of the products from all providers.
     */
    public function indexFromAllProviders(Request $request): ProductCollection
    {
        $type = $request->query('type');
        if ($type === 'review') {
            //dd($this->productService->indexFromAllProvidersWithReview());
            return new ProductCollection($this->productService->indexFromAllProvidersWithReview());
        } else {
            return new ProductCollection($this->productService->indexFromAllProviders());
        }

    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request, $providerId): ProductResource
    {
        $product = $this->productService->store($providerId, $request->validated());
        return new ProductResource($product);
    }

    /**
     * Display the specified product.
     */
    public function show($id): ProductResource
    {
        $product = $this->productService->show($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, $id): ProductResource
    {
        $product = $this->productService->update($id, $request->validated());
        return new ProductResource($product);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->productService->destroy($id);
        return response()->json(null, 204);
    }
}
