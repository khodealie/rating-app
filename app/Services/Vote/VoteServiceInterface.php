<?php

namespace App\Services\Vote;

use App\Models\Vote;
use Illuminate\Pagination\Paginator;

interface VoteServiceInterface
{
    public function summaryIndex($productId): array;

    public function index($productId): Paginator;

    public function store($productId, array $data): Vote;

    public function show($id): Vote;

    public function update($id, array $data): Vote;

    public function destroy($id): void;
}
