<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job_title');
            $table->text('bio');
            $table->string('avatar_path')->nullable();    // round frame photo
            $table->string('portrait_path')->nullable();  // full/half body PNG
            $table->string('display_mode')->default('avatar'); // 'avatar' | 'portrait'
            $table->string('cv_path')->nullable();
            $table->json('social_links')->nullable();     // { github, linkedin, instagram, ... }
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};