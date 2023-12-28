<?php

namespace App\Repositories;

use App\Models\provider;
use App\Repositories\Interfaces\MyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProviderMyRepository implements MyRepositoryInterface
{
    public function index()
    {
        return Provider::simplePaginate(10);
    }

    public function store(array $data): provider
    {
        return Provider::create($data);
    }

    public function show($id): provider
    {
        return Provider::findOrFail($id);
    }

    public function update($id, array $data): provider
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
