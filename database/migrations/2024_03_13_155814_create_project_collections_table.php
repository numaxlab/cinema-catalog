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
        Schema::create('project_collections', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('slug');
            $table->json('description')->nullable();
            $table->string('image_file_path')->nullable();
            $table->string('poster_file_path')->nullable();
            $table->boolean('is_public');
            $table->timestamps();
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
        });


        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('project_collection_id')->nullable();
            $table->foreign('project_collection_id')
                ->references('id')->on('project_collections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_collections');

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('project_collection_id');
            $table->dropForeign('projects_project_collection_id_foreign');
        });
    }
};
