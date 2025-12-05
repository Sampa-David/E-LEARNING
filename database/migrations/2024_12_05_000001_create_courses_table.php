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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->longText('description');
            $table->string('category');
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('duration_hours', 5, 2);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->string('cover_image')->nullable();
            $table->timestamps();
            
            $table->index('teacher_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
