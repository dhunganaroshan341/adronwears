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
        Schema::create('frontends', function (Blueprint $table) {
            $table->id();
            $table->string('about_us_title');
            $table->longText('about_us_description');
            $table->string('about_us_value');
            $table->longText('about_us_value_description');
            $table->string('contact_us_email');
            $table->string('contact_us_address');
            $table->string('contact_us_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontends');
    }
};
