<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'position' => $this->position,
            'is_locked' => $this->is_locked,
            'status' => $this->status,
            'development_days' => $this->development_days,
            'github_url' => $this->github_url,
            'demo_url' => $this->demo_url,
            'technologies' => TechnologyResource::collection($this->whenLoaded('technologies')),
        ];
    }
}
