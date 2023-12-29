<?php

namespace App\Repositories\Provider;

use App\Models\Provider;
use Illuminate\Pagination\Paginator;

class ProviderRepository implements ProviderRepositoryInterface
{
    public function index(): Paginator
    {
        return Provider::latest()->simplePaginate(10);
    }

    public function store(array $data): Provider
    {
        return Provider::create($data);
    }

    public function show($id): Provider
    {
        return Provider::findOrFail($id);
    }

    public function update($id, array $data): Provider
    {
        $provider = $this->show($id);
        $provider->update($data);
        return $provider;
    }

    public function destroy($id): void
    {
        $provider = $this->show($id);
        $provider->delete();
    }
}
