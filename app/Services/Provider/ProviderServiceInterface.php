<?php

namespace App\Services\Provider;


use App\Models\Provider;
use Illuminate\Pagination\Paginator;

interface ProviderServiceInterface
{
    public function index(): Paginator;

    public function store(array $data): Provider;

    public function show($id): Provider;

    public function update($id, array $data): Provider;

    public function destroy($id): void;
}
