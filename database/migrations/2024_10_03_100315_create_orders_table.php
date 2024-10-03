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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // ใช้ id() จะสร้าง primary key โดยอัตโนมัติ
            $table->unsignedBigInteger('user_id');
            $table->decimal('price', 10, 2); // precision 10, scale 2
            $table->integer('quantity'); // จำนวนเหรียญที่สั่งซื้อ
            $table->string('status', 20)->default('pending');
            $table->timestamps(); // สร้าง created_at และ updated_at
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
