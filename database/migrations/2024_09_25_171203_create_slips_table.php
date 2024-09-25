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
        Schema::create('slips', function (Blueprint $table) {
            $table->id('slip_id'); // ใช้ slip_id เป็น primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreign key ที่เชื่อมกับ users
            $table->integer('amount')->notNull(); // จำนวนเงิน
            $table->integer('coins')->notNull(); // จำนวน Coins
            $table->text('slip_path')->notNull(); // เส้นทางไฟล์ slip
            $table->string('status', 20)->default('pending')->notNull(); // สถานะของ slip
            $table->timestamps(); // สร้างคอลัมน์ created_at และ updated_at
            $table->text('admin_note')->nullable(); // หมายเหตุของแอดมิน
        });
    }

    public function down()
    {
        Schema::dropIfExists('slips');
    }
};
