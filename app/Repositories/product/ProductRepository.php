<?php

namespace App\Repositories\product;

use App\Models\Product;
use App\Models\provider;
use App\Services\EnquirySystem\EnquiryService;
use Illuminate\Pagination\Paginator;

class ProductRepository implements ProductRepositoryInterface
{

    public function __construct(private readonly EnquiryService $enquiryService)
    {
    }

    public function index($providerId): Paginator
    {
        $provider = Provider::findOrFail($providerId);
        $products = $provider->products()->where('is_enabled', true)->simplePaginate(10);

        foreach ($products as $product) {
            $product->price = $this->enquiryService->getProductPrice($product->id);
        }

        return $products;
    }

    public function store($providerId, array $data): Product
    {
        $provider = Provider::findOrFail($providerId);
        $product = $provider->products()->create($data);
        $product = $product->fresh();
        $product->price = $this->enquiryService->getProductPrice($product->id);
        return $product;
    }

    private function firstOrFail($id): Product
    {
        return Product::where('id', $id)->where('is_enabled', true)->firstOrFail();
    }

    public function show($id): Product
    {
        $product = $this->firstOrFail($id);
        $product->price = $this->enquiryService->getProductPrice($product->id);
        return $product;
    }

    public function update($id, array $data): Product
    {
        $product = $this->firstOrFail($id);
        $product->update($data);
        $product = $product->fresh();
        $product->price = $this->enquiryService->getProductPrice($product->id);
        return $product;
    }

    public function destroy($id): void
    {
        $product = $this->firstOrFail($id);
        $product->delete();
    }
}
