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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->enum('status',['pending','processing','shipped','delivered','cancelled','refunded'])->default('pending');
            $table->enum('order_type',['normal','custom'])->default('normal');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->enum('payment_status',['pending','completed','failed'])->default('pending');
          $table->string('payment_method')->default('stripe');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
