<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $attributes = [
        "is_active" => false,
    ];

    protected $fillable = [
        "name",
        "type",
        "description",
        "includes",
        "price",
        "duration",
        "is_active"
    ];

    protected function casts(): array {
        return [
            "includes" => "array",
            "price" => "decimal:12",
            "is_active" => "boolean"
        ];
    }
}
