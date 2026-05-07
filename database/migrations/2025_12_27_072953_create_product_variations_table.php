<?php

use App\Enums\StatusEnum;
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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            // Flexible attributes
            $table->json('attributes');

            // Common extracted attributes (IMPORTANT FOR PERFORMANCE)
            $table->string('size')->nullable()->index();
            $table->string('color')->nullable()->index();

            // Core fields
            $table->string('sku')->unique();
            $table->integer('stock')->default(0)->index();

            $table->decimal('price', 10, 2)->nullable()->index();
            $table->decimal('sale_price', 10, 2)->nullable();

            $table->string('image')->nullable();

            $table->string('status')
                ->default(StatusEnum::ACTIVE->value)
                ->index();

            $table->timestamps();

            // Indexes
            $table->index('product_id');
        });
    }
    // things are going to be  like 
    // price, stock, sku, etc can be added later as per requirement
    // i think im going to put an enum somewhere for status too

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
