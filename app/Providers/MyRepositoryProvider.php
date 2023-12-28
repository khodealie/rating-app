<?php

namespace App\Providers;

use App\Repositories\Interfaces\MyRepositoryInterface;
use App\Repositories\ProviderMyRepository;
use Illuminate\Support\ServiceProvider;

class MyRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MyRepositoryInterface::class, ProviderMyRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
