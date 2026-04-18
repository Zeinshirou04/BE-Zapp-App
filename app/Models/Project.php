<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $attributes = [
        "is_maintained" => false,
        "earning" => 0,
        "ended_at" => null,
    ];

    protected $fillable = [
        "title",
        "slug",
        "type",
        "brief",
        "stack",
        "cover_image",
        "earning",
        "is_maintained"
    ];

    public function contributors(): HasMany {
        return $this->hasMany(ProjectContributor::class);
    }

    public function images(): HasMany {
        return $this->hasMany(ProjectImage::class);
    }
    public function timelines(): HasMany {
        return $this->hasMany(ProjectTimeline::class);
    }
}
