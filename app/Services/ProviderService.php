<?php

namespace App\Services;


use App\Models\provider;
use App\Repositories\ProviderMyRepository;
use Illuminate\Database\Eloquent\Collection;

class ProviderService
{
    public function __construct(private ProviderMyRepository $providerRepository)
    {
    }

    public function index()
    {
        return $this->providerRepository->index();
    }

    public function store(array $data): provider
    {
        return $this->providerRepository->store($data);
    }

    public function show($id): provider
    {
        return $this->providerRepository->show($id);
    }

    public function update($id, array $data): provider
    {
        return $this->providerRepository->update($id, $data);
    }

    public function destroy($id): void
    {
        $this->providerRepository->destroy($id);
    }
}
