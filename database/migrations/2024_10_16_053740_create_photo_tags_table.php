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
        Schema::create('Photo_tags', function (Blueprint $table) {
            $table->foreignId('photo_id')->constrained('images')->onDelete('cascade'); // Foreign key referencing images table
            $table->foreignId('tags_id')->constrained('tags', 'tags_id')->onDelete('cascade'); // Update this line
            $table->primary(['photo_id', 'tags_id']); // Composite primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Photo_tags');
    }
};