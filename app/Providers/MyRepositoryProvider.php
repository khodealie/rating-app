<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\product\ProductRepository;
use App\Repositories\product\ProductRepositoryInterface;
use App\Repositories\Provider\ProviderRepository;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\Vote\VoteRepository;
use App\Repositories\Vote\VoteRepositoryInterface;
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
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
        $this->app->bind(VoteRepositoryInterface::class,VoteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
