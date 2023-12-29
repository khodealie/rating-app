<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Services\Comment\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{

    public function __construct(private readonly CommentService $commentService)
    {
    }

    /**
     * Display a listing of the comments.
     */
    public function index($productId): CommentCollection
    {
        $comments = $this->commentService->index($productId);
        $approvedCommentsCount = $this->commentService->getApprovedCommentsCount($productId);

        return (new CommentCollection($comments))->additional([
            'approvedCommentsCount' => $approvedCommentsCount
        ]);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(StoreCommentRequest $request, $productId): CommentResource
    {
        $comment = $this->commentService->store($productId, $request->validated());
        return new CommentResource($comment);
    }

    /**
     * Display the specified comment.
     */
    public function show($id): CommentResource
    {
        $comment = $this->commentService->show($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(UpdateCommentRequest $request, $id): CommentResource
    {
        $comment = $this->commentService->update($id,$request->validated());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->commentService->destroy($id);
        return response()->json(null, 204);
    }
}
