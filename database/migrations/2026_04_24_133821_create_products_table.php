<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('stock_quantity')->default(1);
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('rating')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['active', 'archived'])->default('active');
            $table->boolean('is_customizable')->default(false);
            $table->boolean('allow_engraving')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
