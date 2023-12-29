<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use Illuminate\Pagination\Paginator;

class CommentService implements CommentServiceInterface
{

    public function __construct(private readonly CommentRepository $commentRepository)
    {
    }

    public function getApprovedCommentsCount($productId)
    {
        return $this->commentRepository->getApprovedCommentsCount($productId);
    }

    public function index($productId): Paginator
    {
        return $this->commentRepository->index($productId);
    }

    public function store($productId, array $data): Comment
    {
        return $this->commentRepository->store($productId, $data);
    }

    public function show($id): Comment
    {
        return $this->commentRepository->show($id);
    }

    public function update($id, array $data): Comment
    {
        return $this->commentRepository->update($id, $data);
    }

    public function destroy($id): void
    {
        $this->commentRepository->destroy($id);
    }
}
