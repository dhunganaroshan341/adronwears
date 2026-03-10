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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('our_country_id')->constrained('our_countries')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->json('price_includes')->nullable();
            $table->json('price_excludes')->nullable();
            $table->longText('what_to_expect')->nullable();
            $table->longText('itinerary')->nullable();
            $table->boolean('top_deal')->default(0);
            $table->boolean('favourite_destination')->default(0);
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->string('accomodation')->nullable();
            $table->string('type')->nullable();
            $table->enum('difficulty', ['easy', 'moderate', 'hard'])->nullable();
            $table->enum('package_type', ['trekking', 'tour', 'other'])->default('tour');
            $table->integer('max_elevation')->nullable();
            $table->integer('max_people')->nullable();
            $table->integer('available_seats')->nullable();
            $table->string('best_season')->nullable();
            $table->string('pickup')->default('Tribhuvan International Airport (KTM)');
            $table->string('drop')->default('Tribhuvan International Airport (KTM)');
            $table->string('end_point')->nullable();
            $table->string('start_point')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->json('more_details')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
