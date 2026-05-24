<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactAttachment extends Model
{
    protected $fillable = [
        "submission_id",
        "path",
        "original_name",
        "mime_type",
        "size_bytes"
    ];

    public function submission(): BelongsTo {
        return $this->belongsTo(ContactSubmission::class);
    }
}
