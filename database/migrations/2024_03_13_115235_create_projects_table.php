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
            $table->json('title');
            $table->json('slug');
            $table->string('original_title')->nullable();
            $table->json('synopsis')->nullable();
            $table->string('poster_file_path')->nullable();
            $table->string('main_image_file_path')->nullable();
            $table->json('gallery_files_paths')->nullable();
            $table->string('trailer')->nullable();
            $table->json('awards')->nullable();
            $table->json('festivals')->nullable();
            $table->string('status')->nullable();
            $table->json('tech_info')->nullable();
            $table->json('artistic_info')->nullable();
            $table->json('sponsors')->nullable();
            $table->json('attachments')->nullable();
            $table->json('reviews')->nullable();
            $table->integer('year')->nullable();
            $table->integer('length')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_public');
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
