<?php

namespace App\Providers;

use App\Services\Interfaces\MyServiceInterface;
use App\Services\ProviderService;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MyServiceInterface::class, ProviderService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
