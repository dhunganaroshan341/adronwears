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
        Schema::create('tour_package_services', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('tour_package_id')
                ->constrained('tour_packages')
                ->onDelete('cascade');

            $table->foreignId('service_id')
                ->constrained('services') // assumes there's a 'services' table
                ->onDelete('cascade');

            // Optional contextual title and description for the service
            $table->string('title')->nullable()->comment('Context-specific title for the service');
            $table->text('description')->nullable()->comment('Details or notes about the service for this package');

            // Price can be nullable, but consider using decimal for currency instead of integer
            $table->decimal('price', 10, 2)->nullable()->comment('Optional price adjustment or cost for this service');

            // Better to use enum or boolean for status
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('Service status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_package_services');
    }
};
