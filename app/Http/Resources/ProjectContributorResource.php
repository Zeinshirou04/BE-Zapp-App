<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectContributorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'   => $this->name,
            'role'   => $this->role,
            'avatar' => $this->whenLoaded('user', fn() => $this->user?->avatar_url),
        ];
    }
}
