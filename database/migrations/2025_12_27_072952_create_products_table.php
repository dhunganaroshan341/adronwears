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

            // Category relation
            $table->foreignId('product_category_id')
                ->constrained('product_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Basic product info
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Audience / target group
            $table->string('target_group')->default('unisex');
            // product type
            $table->string('type')->default('simple')->index();
            // simple | bundle

            // optional: store bundle composition
            $table->json('bundle_items')->nullable();
            /*
                Example:
                [
                    {"product_id": 1},
                    {"product_id": 5},
                    {"product_id": 9}
                ]
            */
            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();

            // Flags (inventory + marketing)
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_on_sale')->default(false);

            $table->integer('total_stock')->default(0);

            $table->string('brand_name')->nullable();

            // Media
            $table->string('thumbnail')->nullable();

            // Status
            $table->string('status')->default('active');

            $table->timestamps();

            // =========================
            // INDEXES (OPTIMIZED PART)
            // =========================

            $table->index('product_category_id');
            $table->index('target_group');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_on_sale');
            $table->index('is_new');
            $table->index('created_at');
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
