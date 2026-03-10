<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->longText('message')->nullable();
            $table->unsignedTinyInteger('children')->default(0);
            $table->unsignedTinyInteger('adult')->default(1);
            $table->unsignedSmallInteger('total_people')->default(1);
            $table->decimal('price', 10, 2)->nullable();

          $table->foreignId('tour_package_id')->nullable()->constrained()->onDelete('cascade');

// Either this is filled
$table->foreignId('tour_batch_id')->nullable()->constrained()->onDelete('set null');

            // Or this is filled
            $table->date('custom_date')->nullable();

            $table->string('booking_type')->default('batch'); // 'batch' or 'custom'

            $table->enum('status', ['active', 'inactive', 'pending', 'confirmed', 'cancelled'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
