<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTimeline extends Model
{
    protected $fillable = [
        "project_id",
        "title",
        "description",
        "occurred_at"
    ];

    protected function casts(): array
    {
        return [
            'occurred_at' => 'date',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
