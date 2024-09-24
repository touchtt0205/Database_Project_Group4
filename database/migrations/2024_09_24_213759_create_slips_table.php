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
            $table->id('slip_id'); // ใช้ $table->id() แทน serial
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // สร้าง foreign key
            $table->integer('amount')->notNull();
            $table->integer('coins')->notNull();
            $table->text('slip_path')->notNull();
            $table->string('status', 20)->default('pending')->notNull();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable(); // ใช้ nullable ถ้าไม่ต้องการกรอกข้อมูลที่นี่
            $table->text('admin_note')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('slips');
    }
};
