<?php

namespace App\Providers;

use App\Services\Cache\CacheService;
use App\Services\Cache\CacheServiceInterface;
use App\Services\Comment\CommentService;
use App\Services\Comment\CommentServiceInterface;
use App\Services\EnquirySystem\EnquiryService;
use App\Services\EnquirySystem\EnquiryServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Provider\ProviderService;
use App\Services\Provider\ProviderServiceInterface;
use App\Services\Vote\VoteService;
use App\Services\Vote\VoteServiceInterface;
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
        $this->app->bind(CommentServiceInterface::class,CommentService::class);
        $this->app->bind(VoteServiceInterface::class,VoteService::class);
        $this->app->bind(CacheServiceInterface::class,CacheService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
