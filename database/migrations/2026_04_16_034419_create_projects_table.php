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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("type");
            $table->text("brief");
            $table->json("stack");
            $table->string("cover_image_url");
            $table->decimal("earning", 12, 2)->default(0);
            $table->boolean("is_maintained")->default(false);
            $table->date("started_at");
            $table->date("ended_at")->nullable();
            $table->timestamps();

        });

        Schema::create('project_contributors', function (Blueprint $table) {
            $table->id();

            // Foreign Keys referencing contributors to projects
            $table->foreignId("project_id")->constrained()->cascadeOnDelete();
            $table->foreignId("user_id")->nullable()->constrained()->nullOnDelete();

            $table->string("name");
            $table->string("role");
            $table->timestamps();
        });

        Schema::create("project_timelines", function (Blueprint $table) {
            $table->id();

            // Foreign Key referencing timelines to project
            $table->foreignId("project_id")->constrained()->cascadeOnDelete();

            $table->string("title");
            $table->text("description");
            $table->date("occurred_at");
            $table->timestamps();
        });

        Schema::create("project_images", function (Blueprint $table) {
            $table->id();

            // Foreign Key referencing images to project
            $table->foreignId("project_id")->constrained()->cascadeOnDelete();

            $table->string("path");
            $table->string("caption");
            $table->integer("sort_order");
            $table->timestamps();
            
            $table->index(["project_id", "sort_order"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_contributors');
        Schema::dropIfExists('project_images');
    }
};
