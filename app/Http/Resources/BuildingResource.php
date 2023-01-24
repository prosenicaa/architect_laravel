<?php

namespace App\Http\Resources;

use App\Http\Resources\FlatResource;
use App\Http\Resources\ArchitectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'address' => $this->resource->address,
            'city' => $this->resource->city,
            'date_built' => $this->resource->date_built,
            'architect' =>  new ArchitectResource($this->resource->architect),
            'flat' => new FlatResource($this->resource->flat),
        ];
    }
}
