<?php

namespace App\Services\EnquirySystem;

use Illuminate\Support\Facades\Redis;

class EnquiryService implements EnquiryServiceInterface
{
    public function getProductPrice($productId)
    {
        $cacheKey = "product_{$productId}_price";

        $price = Redis::get($cacheKey);

        if (!$price) {
            $price = rand(1000, 1000000);

            Redis::setex($cacheKey, 3600, $price);
        }
        return $price;
    }
}
