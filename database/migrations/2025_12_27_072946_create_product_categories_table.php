<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusEnum;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete()
                ->index();

            $table->string('slug');

            $table->string('status')
                ->default(StatusEnum::ACTIVE->value)
                ->index();

            $table->integer('sort_order')->default(0);

            $table->boolean('is_featured')->default(false)->index();

            $table->timestamps();

            // Unique slug per category level
            $table->unique(['parent_id', 'slug'], 'parent_slug_unique');

            // Optional safety (recommended if you want global uniqueness instead)
            // $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
