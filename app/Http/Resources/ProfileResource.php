<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'         => $this->name,
            'job_title'    => $this->job_title,
            'bio'          => $this->bio,
            'display_mode' => $this->display_mode,
            'avatar_url'   => $this->avatar_path
                                ? asset('storage/' . $this->avatar_path)
                                : null,
            'portrait_url' => $this->portrait_path
                                ? asset('storage/' . $this->portrait_path)
                                : null,
            'cv_url'       => $this->cv_path
                                ? asset('storage/' . $this->cv_path)
                                : null,
            'social_links' => $this->social_links ?? [],
        ];
    }
}