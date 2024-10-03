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
        Schema::create('order_histories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('order_id'); // Foreign key to orders table
            $table->decimal('coins', 10, 2)->default(0); // Amount of coins involved in the order
            $table->decimal('price', 10, 2); // Price of the order
            $table->string('status'); // Status of the order (e.g., completed, pending)
            $table->timestamps(); // Creates created_at and updated_at columns

            // Optional: If you have foreign keys, you can add them like this
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_histories');
    }
};
