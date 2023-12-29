<?php

namespace App\Services\EnquirySystem;

use App\Services\Cache\CacheService;
use App\Utilities\CacheKeysTemplate;

class EnquiryService implements EnquiryServiceInterface
{
    public function __construct(private readonly CacheService $cacheService)
    {
    }

    public function getProductPrice($productId): int
    {
        $cacheKey = $this->cacheService->generateKey(CacheKeysTemplate::PRODUCT_PRICE, ['productId' => $productId]);

        $price = (int)$this->cacheService->get($cacheKey);

        if (!$price) {
            $price = rand(1, 1000) * 1000;
            $this->cacheService->set($cacheKey, $price, 3600);
        }
        return $price;
    }
}
