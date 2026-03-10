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
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('day_number')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('title')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->text('description');
            $table->timestamps();

            // Add composite unique index for tour_package_id + order
            $table->unique(['tour_package_id', 'order'], 'itineraries_package_order_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
