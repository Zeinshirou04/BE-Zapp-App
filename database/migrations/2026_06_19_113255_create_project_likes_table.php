<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            // SHA-256 hash of IP + User-Agent — 64 hex chars
            $table->char('fingerprint', 64);
            $table->timestamps();

            // One like per visitor per project
            $table->unique(['project_id', 'fingerprint']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_likes');
    }
};