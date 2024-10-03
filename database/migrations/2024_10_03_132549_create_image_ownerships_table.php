<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('image_ownerships', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key

            // Foreign key to users table
            $table->unsignedBigInteger('user_id')->index()->notNull();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Cascade delete

            // Foreign key to images table
            $table->unsignedBigInteger('image_id')->nullable()->index();
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('set null'); // Set null on delete

            $table->text('path')->nullable(); // File path for the image
            $table->timestamp('purchased_at')->useCurrent(); // Default to current timestamp
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_ownerships');
    }
};
