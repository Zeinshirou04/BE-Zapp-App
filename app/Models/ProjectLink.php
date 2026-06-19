<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectLink extends Model
{
    protected $fillable = [
        'project_id',
        'label',
        'url',
        'type',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'sort_order' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}