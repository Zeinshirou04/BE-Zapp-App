<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'path' => asset('storage/' . $this->path),
            'caption' => $this->caption,
            'sort_order' => $this->sort_order,
            'type' => $this->type,  // add this
        ];
    }
}
