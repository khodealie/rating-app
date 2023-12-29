<?php

namespace App\Http\Resources\Vote;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class VoteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public static $wrap = 'votes';

    public function toArray(Request $request): Collection
    {
        return $this->collection;
    }
}
