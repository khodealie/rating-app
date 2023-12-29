<?php

namespace App\Repositories\Comment;

use App\Enums\RatingAccess;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Exceptions\PreconditionFailedException;

class CommentRepository implements CommentRepositoryInterface
{

    public function index($productId): Paginator
    {
        $product = Product::findOrFail($productId);
        return $product->comments()->where('is_approved', true)->latest()->simplePaginate(3);
    }

    /**
     * @throws PreconditionFailedException
     * @throws AccessDeniedHttpException
     */
    public function store($productId, array $data): Comment
    {
        $product = Product::findOrFail($productId);

        if (!$product->is_enabled || !$product->comment_enabled) {
            throw new PreconditionFailedException('Commenting is not allowed on this product.');
        }

        if ($product->rating_access !== RatingAccess::ALL) {
            throw new AccessDeniedHttpException('You are not allowed to comment on this product.');
        }

        $comment = $product->comments()->create($data);
        return $comment->fresh();
    }

    public function show($id): Comment
    {
        return Comment::where('id', $id)->where('is_approved', true)->firstOrFail();
    }

    public function update($id, array $data): Comment
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function destroy($id): void
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }
}
