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
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // สามารถใช้ id เป็น primary key ได้หากจำเป็น
            $table->foreignId('photo_id')
                ->constrained('images')
                ->onDelete('cascade')
                ->notNullable(); // อ้างอิงไปยังตาราง images
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->notNullable(); // อ้างอิงไปยังตาราง users
            $table->timestamps();
            // การกำหนดข้อจำกัดความเป็นเอกลักษณ์
            $table->unique(['photo_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};