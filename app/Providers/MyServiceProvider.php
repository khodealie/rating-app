<?php

namespace App\Providers;

use App\Services\EnquirySystem\EnquiryService;
use App\Services\EnquirySystem\EnquiryServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Provider\ProviderService;
use App\Services\Provider\ProviderServiceInterface;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProviderServiceInterface::class, ProviderService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(EnquiryServiceInterface::class, EnquiryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
