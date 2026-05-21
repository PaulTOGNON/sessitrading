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
        // 1. Create payment_settings table
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_enabled')->default(false);
            $table->string('environment')->default('sandbox');
            $table->string('public_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('webhook_secret')->nullable();
            $table->string('currency')->default('XOF');
            $table->timestamps();
        });

        // 2. Create fedapay_transactions table
        Schema::create('fedapay_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique()->index();
            $table->string('reference')->nullable();
            $table->integer('amount');
            $table->string('currency');
            $table->string('status');
            $table->string('payment_method')->nullable();
            $table->text('raw_response')->nullable();
            $table->timestamps();
        });

        // 3. Add payment fields to orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('Non payé');
            $table->string('payment_method')->default('Mobile Money');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method']);
        });
        Schema::dropIfExists('fedapay_transactions');
        Schema::dropIfExists('payment_settings');
    }
};
