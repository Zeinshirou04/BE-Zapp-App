<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactSubmission extends Model
{
    protected $attributes = [
        "status" => "received"
    ];
    
    protected $fillable = [
        "from_name",
        "from_email",
        "from_phone",
        "subject",
        "content",
        "status"
    ];

    public function attachments(): HasMany {
        return $this->hasMany(ContactAttachment::class);
    }
}
