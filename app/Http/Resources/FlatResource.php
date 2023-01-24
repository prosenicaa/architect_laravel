<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'flat';

    public function toArray($request)
    {
        return [
            'floor' => $this->resource->floor,
            'max_people' => $this->resource->max_people,
            'balcony' => $this->resource->balcony,
            'price' => $this->resource->price
        ];
    }
}
