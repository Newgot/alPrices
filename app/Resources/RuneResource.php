<?php

namespace App\Resources;

use App\Models\Rune;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Rune $resource
 */
class RuneResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getKey(),
            'title' => $this->resource->title,
            'price' => $this->resource->price,
            'city' => $this->resource->city->title,
        ];
    }
}
