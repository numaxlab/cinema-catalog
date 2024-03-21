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
        Schema::create('film_makers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->json('description')->nullable();
            $table->string('image_file_path')->nullable();
            $table->json('image_caption')->nullable();
            $table->boolean('is_public');
            $table->timestamps();
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
        });

        Schema::create('film_maker_project', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('film_maker_id');
            $table->unsignedBigInteger('project_id');


            $table->foreign('film_maker_id')
                ->references('id')->on('film_makers')
                ->onDelete('cascade');
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_makers');
        Schema::dropIfExists('film_maker_project');
    }
};
