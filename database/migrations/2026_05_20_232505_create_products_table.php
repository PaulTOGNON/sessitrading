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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('price');
            $table->integer('original_price')->nullable();
            $table->string('image');
            $table->string('category');
            $table->text('description');
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->integer('reviews_count')->default(12);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_new')->default(false);
            $table->integer('stock')->default(15);
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
