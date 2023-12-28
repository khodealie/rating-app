<?php

namespace App\Providers;

use App\Repositories\product\ProductRepository;
use App\Repositories\product\ProductRepositoryInterface;
use App\Repositories\Provider\ProviderRepository;
use App\Repositories\Provider\ProviderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class MyRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProviderRepositoryInterface::class, ProviderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
