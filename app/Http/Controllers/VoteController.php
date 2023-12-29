<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vote\StoreVoteRequest;
use App\Http\Requests\Vote\UpdateVoteRequest;
use App\Http\Resources\Vote\VoteCollection;
use App\Http\Resources\Vote\VoteResource;
use App\Services\Vote\VoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    public function __construct(private readonly VoteService $voteService)
    {
    }

    /**
     * Display a listing of the votes.
     */
    public function index(Request $request, $productId): VoteCollection|array
    {
        $type = $request->query('type');

        if ($type === 'summary') {
            return $this->voteService->summaryIndex($productId);
        } else {
            return new VoteCollection($this->voteService->index($productId));
        }
    }

    /**
     * Store a newly created vote in storage.
     */
    public function store(StoreVoteRequest $request, $productId): VoteResource
    {
        $vote = $this->voteService->store($productId, $request->validated());
        return new VoteResource($vote);
    }

    /**
     * Display the specified vote.
     */
    public function show($id): VoteResource
    {
        $vote = $this->voteService->show($id);
        return new VoteResource($vote);
    }

    /**
     * Update the specified vote in storage.
     */
    public function update(UpdateVoteRequest $request, $id): VoteResource
    {
        $vote = $this->voteService->update($id, $request->validated());
        return new VoteResource($vote);
    }

    /**
     * Remove the specified vote from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->voteService->destroy($id);
        return response()->json(null, 204);
    }
}
