<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("services", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->text("description");
            $table->json("includes");
            $table->decimal("price");
            $table->string("duration");
            $table->boolean("is_active");
            $table->timestamps();
        });
        
        Schema::create("testimonials", function (Blueprint $table) {
            $table->id();
            $table->string("client_name");
            $table->string("client_photo");
            $table->text("quote");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('testimonials');
    }
};
