<?php

namespace App\Services\Provider;


use App\Models\Provider;
use App\Repositories\Provider\ProviderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class ProviderService implements ProviderServiceInterface
{
    public function __construct(private readonly ProviderRepository $providerRepository)
    {
    }

    public function index(): Paginator
    {
        return $this->providerRepository->index();
    }

    public function store(array $data): Provider
    {
        return $this->providerRepository->store($data);
    }

    public function show($id): Provider
    {
        return $this->providerRepository->show($id);
    }

    public function update($id, array $data): Provider
    {
        return $this->providerRepository->update($id, $data);
    }

    public function destroy($id): void
    {
        $this->providerRepository->destroy($id);
    }
}
