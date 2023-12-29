<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        $product = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'isEnabled' => $this->is_enabled,
            'voteEnabled' => $this->vote_enabled,
            'commentEnabled' => $this->comment_enabled,
            'ratingAccess' => $this->rating_access,
        ];
        if ($this->relationLoaded('lastThreeComments') && $this->lastThreeComments->isNotEmpty()) {
            $product['lastThreeComments'] = new CommentCollection($this->lastThreeComments);
        }
        if ($this->voteSummary && !empty($this->voteSummary)) {
            $product['voteSummary'] = $this->voteSummary;
        }
        if ($this->approvedCommentsCount) {
            $product['approvedCommentsCount'] = $this->approvedCommentsCount;
        }
        return $product;
    }
}
