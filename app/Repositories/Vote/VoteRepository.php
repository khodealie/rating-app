<?php

namespace App\Repositories\Vote;

use App\Enums\RatingAccess;
use App\Models\Product;
use App\Models\Vote;
use App\Services\Cache\CacheService;
use App\Utilities\CacheKeysTemplate;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Exceptions\PreconditionFailedException;

class VoteRepository implements VoteRepositoryInterface
{
    public function __construct(private readonly CacheService $cacheService)
    {
    }

    public function summaryIndex($productId): array
    {
        $summary = [];
        $totalVotes = 0;
        $weightedSum = 0;

        for ($rate = 1; $rate <= 5; $rate++) {
            $cacheKey = $this->cacheService->generateKey(
                CacheKeysTemplate::PRODUCT_VOTE_COUNT,
                ['productId' => $productId, 'rateNumber' => $rate]
            );

            $rateCount = (int) $this->cacheService->get($cacheKey) ?? 0;
            $summary["rate{$rate}Count"] = $rateCount;

            // Calculate the weighted sum and total votes
            $weightedSum += $rate * $rateCount;
            $totalVotes += $rateCount;
        }

        // Calculate the average rating, avoiding division by zero
        $averageRating = $totalVotes > 0 ? $weightedSum / $totalVotes : 0;
        $summary['averageRating'] = round($averageRating, 2); // Round to 2 decimal places

        return $summary;
    }

    public function index($productId): Paginator
    {
        $product = Product::findOrFail($productId);
        return $product->votes()->where('is_approved', true)->latest()->simplePaginate(3);
    }

    /**
     * @throws PreconditionFailedException
     * @throws AccessDeniedHttpException
     */
    public function store($productId, array $data): Vote
    {
        $product = Product::findOrFail($productId);

        if (!$product->is_enabled || !$product->vote_enabled) {
            throw new PreconditionFailedException('Voting is not allowed on this product.');
        }

        if ($product->rating_access !== RatingAccess::ALL) {
            throw new AccessDeniedHttpException('You are not allowed to vote on this product.');
        }

        $vote = $product->votes()->create($data);
        return $vote->fresh();
    }

    public function show($id): Vote
    {
        return Vote::where('id', $id)->where('is_approved', true)->firstOrFail();
    }

    public function update($id, array $data): Vote
    {
        $vote = Vote::findOrFail($id);
        $cacheKey = $this->cacheService->generateKey(
            CacheKeysTemplate::PRODUCT_VOTE_COUNT,
            ['productId' => $vote->product_id, 'rateNumber' => $vote->vote]
        );
        if (!$vote->is_approved && $data['is_approved']) $this->cacheService->increment($cacheKey);
        elseif ($vote->is_approved && !$data['is_approved']) $this->cacheService->reduce($cacheKey);
        $vote->update($data);
        return $vote;
    }

    public function destroy($id): void
    {
        $vote = Vote::findOrFail($id);
        $vote->delete();
    }
}
