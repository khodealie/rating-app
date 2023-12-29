<?php

namespace App\Services\Vote;

use App\Models\Vote;
use App\Repositories\Vote\VoteRepository;
use Illuminate\Pagination\Paginator;

class VoteService implements VoteServiceInterface
{

    public function __construct(private readonly VoteRepository $voteRepository)
    {
    }

    public function summaryIndex($productId): array
    {
        return $this->voteRepository->summaryIndex($productId);
    }

    public function index($productId): Paginator
    {
        return $this->voteRepository->index($productId);
    }

    public function store($productId, array $data): Vote
    {
        return $this->voteRepository->store($productId, $data);
    }

    public function show($id): Vote
    {
        return $this->voteRepository->show($id);
    }

    public function update($id, array $data): Vote
    {
        return $this->voteRepository->update($id, $data);
    }

    public function destroy($id): void
    {
        $this->voteRepository->destroy($id);
    }
}
