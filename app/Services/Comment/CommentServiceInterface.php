<?php

namespace App\Services\Comment;

use App\Models\Comment;
use Illuminate\Pagination\Paginator;

interface CommentServiceInterface
{
    public function index($productId): Paginator;

    public function store($productId, array $data): Comment;

    public function show($id): Comment;

    public function update($id, array $data): Comment;

    public function destroy($id): void;
}
