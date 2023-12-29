<?php

namespace App\Services\Product;


use App\Models\Product;
use App\Repositories\product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class ProductService implements ProductServiceInterface
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function indexFromAllProviders(): Paginator
    {
        return $this->productRepository->indexFromAllProviders();
    }

    public function indexFromAllProvidersWithReview()
    {
        return $this->productRepository->indexFromAllProvidersWithReview();
    }

    public function index($providerId): Paginator
    {
        return $this->productRepository->index($providerId);
    }

    public function store($providerId, array $data): Product
    {
        return $this->productRepository->store($providerId, $data);
    }

    public function show($id): Product
    {
        return $this->productRepository->show($id);
    }

    public function update($id, array $data): Product
    {
        return $this->productRepository->update($id, $data);
    }

    public function destroy($id): void
    {
        $this->productRepository->destroy($id);
    }
}
