<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Redis;

class CacheService
{

    /**
     * Retrieve an item from the cache.
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return Redis::get($key);
    }

    /**
     * Store an item in the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $expiration (minutes)
     * @return void
     */
    public function set(string $key, $value, ?int $expiration = null): void
    {
        if (is_null($expiration)) {
            Redis::set($key, $value);
        } else {
            Redis::setex($key, $expiration, $value);
        }
    }

    /**
     * Increment the value of an item in the cache.
     *
     * @param string $key
     * @return int
     */
    public function increment(string $key): int
    {
        return Redis::incr($key);
    }

    /**
     * Decrement the value of an item in the cache.
     *
     * @param string $key
     * @return int
     */
    public function reduce(string $key): int
    {
        return Redis::decr($key);
    }

    /**
     * Generate a standardized cache key with dynamic replacements.
     *
     * @param string $templateKey The template key with placeholders
     * @param array $replacements Associative array of placeholders and their replacements
     * @return string
     */
    public function generateKey(string $templateKey, array $replacements = []): string
    {
        foreach ($replacements as $placeholder => $replacement) {
            $templateKey = str_replace("{{$placeholder}}", $replacement, $templateKey);
        }
        return $templateKey;
    }
}
