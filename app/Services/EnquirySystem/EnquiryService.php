<?php

namespace App\Services\EnquirySystem;

use Illuminate\Support\Facades\Redis;

class EnquiryService implements EnquiryServiceInterface
{
    public function getProductPrice($productId)
    {
        $cacheKey = "product_{$productId}_price";

        $price = (int)Redis::get($cacheKey);

        if (!$price) {
            $price = rand(1, 1000) * 1000;

            Redis::setex($cacheKey, 3600, $price);
        }
        return $price;
    }
}
