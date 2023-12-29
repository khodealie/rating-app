<?php

namespace App\Services\Cache;

interface CacheServiceInterface
{
    public function get(string $key);

    public function set(string $key, $value, ?int $expiration = null);

    public function increment(string $key): int;

    public function reduce(string $key): int;
}
