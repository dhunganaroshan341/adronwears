<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_batches', function (Blueprint $table) {
            $table->id();

            // Foreign key to tour_packages
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');

            // Dates
            $table->date('start_date');
            $table->date('end_date')->nullable();

            // Batch-specific details
            $table->integer('max_people');
            $table->integer('available_seats'); // Decreases as people book

            // Optional batch pricing
            $table->integer('price')->nullable();

            $table->enum('status', ['active', 'full', 'closed'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_batches');
    }
};
