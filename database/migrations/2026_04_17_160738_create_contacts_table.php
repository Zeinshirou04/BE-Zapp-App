<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("contact_submissions", function (Blueprint $table) {
            $table->id();
            $table->string("from_name");
            $table->string("from_email");
            $table->string("from_phone");
            $table->string("subject");
            $table->text("content");
            $table->string("status")->default("received");
            $table->timestamps();
        });
        
        Schema::create("contact_attachments", function (Blueprint $table) {
            $table->id();

            // Foreign Key referencing contributors to submissions
            $table->foreignId("submission_id")->references("id")->on("contact_submissions");

            $table->string("path");
            $table->string("original_name");
            $table->string("mime_type");
            $table->bigInteger("size_bytes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("contact_submissions");
        Schema::dropIfExists("contact_attachments");
    }
};
