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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->string('purchase_link')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                ->references('id')->on('projects');
            $table->unsignedBigInteger('cinema_id');
            $table->foreign('cinema_id')
                ->references('id')->on('cinemas');
            $table->timestamps();
            $table->boolean('is_public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
