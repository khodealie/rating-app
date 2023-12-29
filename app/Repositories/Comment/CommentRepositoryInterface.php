<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Pagination\Paginator;

interface CommentRepositoryInterface
{

    public function getApprovedCommentsCount($productId);

    public function index($productId): Paginator;

    public function store($productId, array $data): Comment;

    public function show($id): Comment;

    public function update($id, array $data): Comment;

    public function destroy($id): void;
}
