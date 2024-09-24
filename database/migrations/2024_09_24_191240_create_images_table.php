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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('price')->default(0);
            $table->text('title')->nullable();
            $table->integer('max_sales')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};
