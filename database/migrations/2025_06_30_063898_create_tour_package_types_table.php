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
        Schema::create('package_types', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique()->comment('title of the package type'); // Unique name for the package type
            $table->string('short_desc', 255)->nullable()->comment('Short description of the package type'); // Optional short description
            $table->text('description')->nullable()->comment('Detailed description of the package type'); // Optional detailed description
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('Status of the package type'); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_types');
    }
};
