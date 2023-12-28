<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Http\Resources\ProviderCollection;
use App\Http\Resources\ProviderResource;
use App\Services\Provider\ProviderService;
use Illuminate\Http\JsonResponse;

class ProviderController extends Controller
{

    public function __construct(private readonly ProviderService $providerService)
    {
    }

    /**
     * Display a listing of the providers.
     */
    public function index(): ProviderCollection
    {
        $providers = $this->providerService->index();
        return new ProviderCollection($providers);
    }

    /**
     * Store a newly created provider in storage.
     */
    public function store(StoreProviderRequest $request): ProviderResource
    {
        $provider = $this->providerService->store($request->validated());
        return new ProviderResource($provider);
    }

    /**
     * Display the specified provider.
     */
    public function show($id): ProviderResource
    {
        $provider = $this->providerService->show($id);
        return new ProviderResource($provider);
    }

    /**
     * Update the specified provider in storage.
     */
    public function update(UpdateProviderRequest $request, $id): ProviderResource
    {
        $provider = $this->providerService->update($id, $request->validated());
        return new ProviderResource($provider);
    }

    /**
     * Remove the specified provider from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->providerService->destroy($id);
        return response()->json(null, 204);
    }
}
