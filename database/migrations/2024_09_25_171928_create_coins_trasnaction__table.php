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
        Schema::create('coin_transactions', function (Blueprint $table) {
            $table->id('transaction_id'); // ใช้ $table->id() แทน serial
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // สร้าง foreign key
            $table->integer('amount')->notNull();
            $table->string('transaction_type', 50)->notNull();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coin_transactions');
    }
};
