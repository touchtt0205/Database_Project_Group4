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
        Schema::create('membership_transactions', function (Blueprint $table) {
            $table->id('transaction_id'); // ใช้ $table->id() แทน serial
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // สร้าง foreign key
            $table->integer('amount')->notNull();
            $table->string('transaction_type', 50)->notNull();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_transactions');
    }
};