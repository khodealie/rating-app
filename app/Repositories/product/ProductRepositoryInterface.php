<?php

namespace App\Repositories\product;

use App\Models\Product;
use Illuminate\Pagination\Paginator;

interface ProductRepositoryInterface
{
    public function index($providerId):Paginator;
    public function store($providerId, array $data): Product;
    public function show($id): Product;
    public function update($id, array $data): Product;
    public function destroy($id): void;
}
