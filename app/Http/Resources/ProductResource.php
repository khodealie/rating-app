<?php

namespace App\Http\Resources;

use App\Services\EnquirySystem\EnquiryService;
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_enabled' => $this->is_enabled,
            'vote_enabled' => $this->vote_enabled,
            'comment_enabled' => $this->comment_enabled,
            'rating_access' => $this->rating_access,
        ];
    }
}
