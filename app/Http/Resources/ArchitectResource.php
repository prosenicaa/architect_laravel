<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArchitectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'architect';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'skills' => $this->resource->skills,
            'title' => $this->resource->title,
        ];
    }
}
