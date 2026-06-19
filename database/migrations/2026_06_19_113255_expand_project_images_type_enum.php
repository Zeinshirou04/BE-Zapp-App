<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // MariaDB doesn't support modifying ENUMs directly via ->change(),
        // so we alter the column with a raw statement.
        DB::statement("
            ALTER TABLE project_images
            MODIFY COLUMN type ENUM('screenshot','certificate','documentary','other')
            NOT NULL DEFAULT 'screenshot'
        ");
    }

    public function down(): void
    {
        // Revert — rows with 'documentary'/'other' will fail if data exists;
        // truncate or update those rows before rolling back.
        DB::statement("
            ALTER TABLE project_images
            MODIFY COLUMN type ENUM('screenshot','certificate')
            NOT NULL DEFAULT 'screenshot'
        ");
    }
};