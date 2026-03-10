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
        Schema::create('shipping_requests', function (Blueprint $table) {
            $table->id();

            // Shipping always comes from cart
            $table->foreignId('cart_id')
                ->constrained()
                ->cascadeOnDelete();

            // User (optional)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Guest info (if not logged in)
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();

            // Shipping address
            $table->string('address_line');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Nepal');

            // Shipping status
            $table->enum('status', [
                'pending',
                'confirmed',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_requests');
    }
};
