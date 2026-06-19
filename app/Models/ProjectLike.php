<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectLike extends Model
{
    protected $fillable = [
        'project_id',
        'fingerprint',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}