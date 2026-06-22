<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'job_title',
        'bio',
        'avatar_path',
        'portrait_path',
        'display_mode',
        'cv_path',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}