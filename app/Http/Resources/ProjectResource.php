<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'type' => $this->type,
            'brief' => $this->brief,
            // stack is now array of { name, version } objects
            'stack' => $this->stack ?? [],
            'cover_image_url' => $this->cover_image_url
                ? asset('storage/' . $this->cover_image_url)
                : null,
            'earning' => $this->earning,
            'is_maintained' => $this->is_maintained,
            'started_at' => $this->started_at?->toDateString(),
            'ended_at' => $this->ended_at?->toDateString(),
            'likes_count' => $this->likes_count ?? $this->likes()->count(),

            // Only included when the relation was eager-loaded (detail endpoint)
            'images' => ProjectImageResource::collection($this->whenLoaded('images')),
            'timelines' => ProjectTimelineResource::collection($this->whenLoaded('timelines')),
            'contributors' => ProjectContributorResource::collection($this->whenLoaded('contributors')),
            'links' => ProjectLinkResource::collection($this->whenLoaded('links')),
        ];
    }
}