<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\Comment\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{

    public function __construct(private readonly CommentService $commentService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index($productId): CommentCollection
    {
        $comments = $this->commentService->index($productId);
        return new CommentCollection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, $productId): CommentResource
    {
        $comment = $this->commentService->store($productId, $request->validated());
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): CommentResource
    {
        $comment = $this->commentService->show($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, $id): CommentResource
    {
        $comment = $this->commentService->update($id,$request->validated());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->commentService->destroy($id);
        return response()->json(null, 204);
    }
}
